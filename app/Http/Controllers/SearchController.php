<?php

namespace Faf\Http\Controllers;

use DB;
use Faf\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
        
	}

	
	public function getResults(Request $request)
	{

		$query = $request->input('query');

		if (!$query) {

			return redirect()->route('home');
		}

		$users = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%{$query}%")
			->orWhere('username', 'LIKE', "%{$query}%")
			->get();

		

		return view('search.results')->with('users',$users);
	}

}



