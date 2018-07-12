<?php

namespace Faf\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    
    public function __construct()
    {
    	$this->middleware('guest:admin');

    }


    public function index()
    {
    	return view('admin.adminhome');
    }


    public function showLoginForm()
    {
    	return view('auth.admin-signin');
    }
    

    public function login(Request $request)
    {
    	
    	//validate form data

    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:8'

    	]);

    	//attemp to login

    	if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password], $request->remember)) {

    		// if successful, redirect to their inteded location
    		
    		return redirect()->intended(route('admin.dashboard'));

    	} 

        return redirect()->back()->withInput($request->only('email','username','remember'));

    }



  

}
