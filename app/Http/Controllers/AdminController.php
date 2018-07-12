<?php



namespace Faf\Http\Controllers;

use Auth;
use DB;
use Faf\Models\Admin;
use Faf\Models\User;
use Faf\Models\Status;
use Faf\Models\Like;
use Faf\Models\Ban;
use Illuminate\Http\Request;


class AdminController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth:admin',[
            'except' => ['admin.login']
        ]);

        
	}

	public function index()
	{
       

		$admins = Admin::all();
        $users= User::all();
		return view('admin.adminhome')
        ->with('admins',$admins)
        ->with('users',$users);
	}

	
    public function getAdminSignOut()
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }


    public function getUsersList()
    {
    	$admins = Admin::all();
    	$users = User::all();

    	return view('admin.users.masterlist')
    	->with('admins',$admins)
    	->with('users',$users);
    }

    public function getUserSettings($userId)
    {
        $statuses = Status::all()->whereIn('user_id',$userId);
        $users = User::find($userId);
        

        return view('admin.users.settings')
        ->with('users',$users)
        ->with('userId', $userId)
        ->with('statuses', $statuses);
    }

    public function getBannableUsers(Request $request)
    {

        $bannables = Ban::all();        
        $users = User::all();



        return view('admin.users.bannable')
        ->with('users',$users)     
        ->with('bannables',$bannables);

    }

    public function getBannableDetails(Request $request)
    {

       $userQuery = $request->get('userQuery'); //user ID
       $userStatuses = DB::table('statuses')->where('user_id','=',$userQuery)->get();

       $bannableStatuses = Ban::all();
       $bannableUsers = DB::table('users')->where('id','=',$userQuery)->first();
        
        $statusBannables = DB::table('statuses')
        ->join('bannable','statuses.id','=','bannable.bannable_id')
        ->join('users','statuses.user_id','=','users.id')
        ->where('users.id','=',$userQuery)
        ->get();

        return view('admin.users.bannable_details')
         ->with('bannableUsers', $bannableUsers)
         ->with('userStatuses',$userStatuses)
         ->with('statusBannables', $statusBannables);
    }


    public function searchForBannableUsers(Request $request)
    {

        $search = $request->input('searchForBannableUsers');

        if (!$search) {
            return redirect()->route('admin.bannable');
        }

        $bannableUsers = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%{$search}%")
            ->orWhere('username', 'LIKE', "%{$search}%")
            ->get();

        
        return view('admin.users.searchBannables')
        ->with('bannableUsers',$bannableUsers);
    }



    public function getAdminSettings(Request $request)
    {
        $requests = Admin::all();

        return view('admin.users.adminSettings')
        ->with('requests', $requests);
    }


     public function adminDeleteOptions(Request $request, $userId)
    {
     
       $delMe = $request->get('delUser1');

            $findUserToDelete = User::find($userId);

            $findUserToDelete->delete();

            return redirect()->route('admin.bannable')
            ->with('info','You have deleted the user.');
        

    }

    public function delBannablePost($bannableId)
    {
        $delPost = Ban::where('bannable_id','=',$bannableId)->first();

        $delPost->delete();

        return redirect()->route('admin.bannable')
        ->with('info','Successfully deleted user post.');
    }


    public function delBannablePostTimeline($bannableId)
    {
       $delPostInTimeLine = Status::where('id','=',$bannableId)->first();
       $delPostInBan = Ban::where('bannable_id','=',$bannableId)->first();
       $delPostInTimeLine->delete();
       $delPostInBan->delete();

        return redirect()->route('admin.bannable')
        ->with('info','Successfully deleted user post.');

    }

}



