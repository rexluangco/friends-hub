<?php

namespace Faf\Http\Controllers;

use Auth;
use Faf\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
        
	}
	

	public function getProfile($username)
	{

		$user = User::where('username', $username)->first();

		if (!$user) {
			abort(404);
		}

		$statuses = $user->statuses()->notReply()->get();

		return view('profile.index')
			->with('user',$user)
			->with('statuses', $statuses)
			->with('authUserIsFriend', Auth::user()->isFriendsWith($user));
	}


	public function getEdit()
	{
		return view('profile.edit');

	}


	public function postEdit(Request $request)
	{

		$this->validate($request, [
			'first_name'=>'max:50',
			'last_name'=>'max:50',
			'location'=>'max:100',
			'intro' =>'max:120',
		

		]);

		//File upload for avatar
		$existingAvatar = Auth::user()->avatar;
	

		if ($request->hasfile('avatar')) {
			$avatarWithExt = $request->file('avatar')->getClientOriginalName();
			$avatarFilename = pathinfo($avatarWithExt,PATHINFO_FILENAME);
			$avatarExtension = $request->file('avatar')->getClientOriginalExtension();
			$avatarFilenameToStore = $avatarFilename.'_'.time().'.'.$avatarExtension;
			$avatarpath = $request->file('avatar')->storeAs('public/prof_images',$avatarFilenameToStore);


		}elseif($existingAvatar)
		{
			$avatarFilenameToStore = $existingAvatar;

		}else
		{
			$avatarFilenameToStore = 'default.png';
		}

		


		Auth::user()->update([

			'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
			'civil_status' => $request->input('civil_status'),
			'location' => $request->input('location'),
			'intro' => $request->input('intro'),
			'avatar' => $avatarFilenameToStore,

			]);

		return redirect()
			->route('profile.edit')
			->with('info','Your profile has been updated.');
	}


	public function getUserInfo(Request $request)
	{
		return view('profile.editCredentials');

	}

	public function postUserInfo(Request $request)
	{

		$this->validate($request, [
			'email'=> 'required|email|max:255',
			'username' => 'required|max:20|min:6',
			'password'=> 'required|min:8',
		]);


		Auth::user()->update([
			'email' => $request->input('email'),
			'username' => $request->input('username'),
			'password' => bcrypt($request->input('password')),

		]);

		return redirect()->route('auth.signout')
		->with('info','Update successful.You may now login using the updated credentials.');
	}





	public function updateCoverPhoto(Request $request)
	{
		$this->validate($request, [
			'cover_image' => 'image|nullable|max:2999'
		]);

		if ($request->hasfile('cover_image')) {
			$filenameWithExt = $request->file('cover_image')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
			$extension = $request->file('cover_image')->getClientOriginalExtension();
			$filenameToStore = $filename.'_'.time().'.'.$extension;
			$path = $request->file('cover_image')->storeAs('public/cover_images',$filenameToStore);

		}else{
			$filenameToStore = 'default.png';
		}		


		Auth::user()->update([
			'cover_image' =>$filenameToStore
		]);


		return redirect()->route('profile.index',Auth::user()->username)
		->with('info','Profile cover photo has been updated.');
	}

}



