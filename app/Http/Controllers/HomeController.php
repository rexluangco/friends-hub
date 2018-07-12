<?php



namespace Faf\Http\Controllers;

use Auth;
use Faf\Models\User;
use Faf\Models\Ban;
use Faf\Models\Status;

class HomeController extends Controller
{


	public function index()
	{
		if (Auth::check()) {
				$statuses = Status::notReply()->where(function($query){
					return $query->where('user_id', Auth::user()->id)
					->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));

				})
				->orderby('created_at', 'desc')
				->paginate(10);
		}

		if (Auth::check()) {
			return view('timeline.index')
				->with('statuses', $statuses);
		}

		return view('home');
	}


}



