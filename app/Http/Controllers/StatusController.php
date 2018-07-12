<?php

namespace Faf\Http\Controllers;

use DB;
use Auth;
use Faf\Models\User;
use Faf\Models\Status;
use Faf\Models\Like;
use Faf\Models\Ban;
use Illuminate\Http\Request;


class StatusController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
        
	}



	public function postStatus(Request $request)
	{
		$this->validate($request, [
			'status' => 'required|max:1000',
			'statusImageUpload' => 'image|max:25000'
		]);


		//File upload for avatar
		if ($request->hasfile('statusImageUpload')) {
			$filenameWithExt = $request->file('statusImageUpload')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
			$extension = $request->file('statusImageUpload')->getClientOriginalExtension();
			$filenameToStore = $filename.'_'.time().'.'.$extension;
			$path = $request->file('statusImageUpload')->storeAs('public/images',$filenameToStore);

		}else{

			$filenameToStore = null;
		}

		
		Auth::user()->statuses()->create([
			'body' => $request->input('status'),
			'statusImageUpload' => $filenameToStore,
		]);
		
		return redirect()->route('home')->with('info','Status posted.');
	}


	public function postReply(Request $request, $statusId)
	{


		$this->validate($request, 
			[
			"reply-{$statusId}" => 'required|max:1000',
		], [

			'required' => 'The reply body is required.'

			]);


			$status = Status::notReply()->find($statusId);

			
			if (!$status) {
				return redirect()->route('home');
			}

			if (!Auth::user()->isFriendsWith($status->user) && Auth::user()->id !== $status->user->id) {
				return redirect()->route('home');
			}



			$reply = Status::create([

				'body'=> $request->input("reply-{$statusId}"),

			])->user()->associate(Auth::user());

			$status->replies()->save($reply);
			
			return redirect()->back();
	}




	public function getLike($statusId)
	{


		$status = Status::find($statusId);

		if (!$status) {
			return redirect()->route('home');
		}

		if (!Auth::user()->isFriendsWith($status->user)) {
			return redirect()->route('home');
		}

		if (Auth::user()->hasLikedStatus($status)) {
			return redirect()->back();
		}

		$like = $status->likes()->create([]);
		Auth::user()->likes()->save($like);

		return redirect()->back();
	}


	public function unLike($statusId)
	{

		$status = Status::find($statusId)->id;
		
		$unlike = DB::table('likeable')->whereIn('likeable_id',array($status))->delete();
		
		return redirect()->back();	
	}


	public function getReport(Request $request, $statusId)
	{
		
		$findReportedStatuses = DB::table('statuses')->where('id','=',$statusId)->first();
		$findOwnerOfReportedStatus =  $findReportedStatuses->user_id;
		$users = User::find($findOwnerOfReportedStatus);

		
		return view('reports.index')
		->with('findReportedStatuses',$findReportedStatuses)
		->with('users',$users);
		
	}



	public function reportUser(Request $request, $statusId)
	{
		$status = Status::find($statusId);
		$authUser = Auth::user()->id;
		$existingBannableUser = DB::table('bannable')->whereIn('user_id',array($status))->get();
		
			$bans = $status->bans()->create([

			'reportedFor' => $request->input('blockReasons'),
			'reportedBy' => Auth::user()->getNameOrUsername(),
			
			]);
		Auth::user()->bans()->save($bans);	
		return redirect()->route('home')
		->with('info','Post has been reported.');
	}
	

	public function delMyStatus($delStatusId)
	{
		$delMyPost = Status::where('id','=',$delStatusId)->first();
		$delMyPost->delete();

		return redirect()->back()
		->with('info','Post deleted.');

	}
	
}



