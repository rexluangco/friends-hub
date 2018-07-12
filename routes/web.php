<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/', [
'uses'=> '\Faf\Http\Controllers\HomeController@index',
'as' => 'home',
]);



Route::get('/alert', function(){

	return redirect()->route('home')->with('info','You have signed up');
});



Route::get('/signup', [

	'uses'=> '\Faf\Http\Controllers\AuthController@getSignup',
	'as' => 'auth.signup',
	'middleware' => ['guest'],

]);


Route::post('/signup', [

	'uses'=> '\Faf\Http\Controllers\AuthController@postSignup',
	'middleware' => ['guest'],

]);


Route::get('/signin', [

	'uses'=> '\Faf\Http\Controllers\AuthController@getSignin',
	'as' => 'auth.signin',
	'middleware' => ['guest'],
]);



Route::post('/signin', [

	'uses'=> '\Faf\Http\Controllers\AuthController@postSignin',
	'middleware' => ['guest'],
]);


Route::get('/signout', [

	'uses'=> '\Faf\Http\Controllers\AuthController@getSignOut',
	'as' => 'auth.signout',

]);


Route::get('/search', [
	'uses' => '\Faf\Http\Controllers\SearchController@getResults',
	'as' => 'search.results',
	'middleware' => 'auth',
]);


Route::get('/user/{username}', [
	'uses' => '\Faf\Http\Controllers\ProfileController@getProfile',
	'as' => 'profile.index',
	'middleware' => 'auth',

]);

Route::post('/user/{username}', [
	'uses' => '\Faf\Http\Controllers\ProfileController@updateCoverPhoto',
	'as' => 'profile.index',
	'middleware' => ['auth'],

]);


Route::get('/profile/edit', [
	'uses' => '\Faf\Http\Controllers\ProfileController@getEdit',
	'as' => 'profile.edit',
	'middleware' => ['auth'],

]);


Route::post('/profile/edit', [
	'uses' => '\Faf\Http\Controllers\ProfileController@postEdit',
	'as' => 'profile.edit',
	'middleware' => ['auth'],

]);



Route::get('/profile/userinfo',[
	'uses' => '\Faf\Http\Controllers\ProfileController@getUserInfo',
	'as' => 'profile.edit_userinfo',
	'middleware' => ['auth'],

]);

Route::post('/profile/userinfo',[
	'uses' => '\Faf\Http\Controllers\ProfileController@postUserInfo',
	'as' => 'profile.edit_userinfo',
	'middleware' => ['auth'],

]);





Route::get('/friends', [

	'uses' => '\Faf\Http\Controllers\FriendController@getIndex',
	'as' => 'friend.index',
	'middleware' => ['auth'],
]);


Route::get('/friends/add/{username}', [

	'uses' => '\Faf\Http\Controllers\FriendController@getAdd',
	'as' => 'friend.add',
	'middleware' => ['auth'],
]);


Route::get('/friends/accept/{username}', [

	'uses' => '\Faf\Http\Controllers\FriendController@getAccept',
	'as' => 'friend.accept',
	'middleware' => ['auth'],
]);



Route::post('/friends/delete/{username}', [

	'uses' => '\Faf\Http\Controllers\FriendController@postDelete',
	'as' => 'friend.delete',
	'middleware' => ['auth'],
]);


// Status routes

Route::post('/status', [

	'uses' => '\Faf\Http\Controllers\StatusController@postStatus',
	'as' => 'status.post',
	'middleware' => ['auth'],
]);


Route::post('/status/{statusId}/reply', [

	'uses' => '\Faf\Http\Controllers\StatusController@postReply',
	'as' => 'status.reply',
	'middleware' => ['auth'],
]);


Route::get('/status/{statusId}/like', [

	'uses' => '\Faf\Http\Controllers\StatusController@getLike',
	'as' => 'status.like',
	'middleware' => ['auth'],
]);

Route::get('/status/{statusId}/unlike', [

	'uses' => '\Faf\Http\Controllers\StatusController@unLike',
	'as' => 'status.unlike',
	'middleware' => ['auth'],
]);



Route::get('/status/{delStatusId}/delete', [
	'uses' => '\Faf\Http\Controllers\StatusController@delMyStatus',
	'as' => 'status.delMyPost',
	'middleware' => ['auth'],

]);


Route::get('/status/{userId}/report', [

	'uses' => '\Faf\Http\Controllers\StatusController@getReport',
	'as' => 'status.report',
	'middleware' => ['auth'],
]);



Route::post('/status/{statusId}/report_user', [

	'uses' => '\Faf\Http\Controllers\StatusController@reportUser',
	'as' => 'status.report_user',
	'middleware' => ['auth'],
]);


//admin

Route::prefix('admin')->group(function(){

	Route::get('/login','AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login','AdminLoginController@login')->name('admin.login.submit');
	Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

});


Route::get('/admin/signout', [

	'uses'=> '\Faf\Http\Controllers\AdminController@getAdminSignOut',
	'as' => 'admin.signout',

]);

Route::get('/admin/signout', [

	'uses'=> '\Faf\Http\Controllers\AdminController@getAdminSignOut',
	'as' => 'admin.signout',

]);

Route::get('/admin/masterlist', [

	'uses' => '\Faf\Http\Controllers\AdminController@getUsersList',
	'as' => 'admin.masterlist',
	'middleware' => ['auth:admin'],

]);


Route::get('/admin/masterlist/{userId}/settings', [

	'uses' => '\Faf\Http\Controllers\AdminController@getUserSettings',
	'as' => 'admin.user_settings',
	'middleware' => ['auth:admin'],


]);

Route::get('/admin/reports', [

	'uses' => '\Faf\Http\Controllers\AdminController@getBannableUsers',
	'as' => 'admin.bannable',
	'middleware' => ['auth:admin'],

]);


Route::post('/admin/reports/query', [

	'uses' => '\Faf\Http\Controllers\AdminController@getBannableDetails',
	'as' => 'admin.bannable_details',
	'middleware' => ['auth:admin'],

]);


Route::post('admin/reports/query/search',[
	'uses' => '\Faf\Http\Controllers\AdminController@searchForBannableUsers',
	'as' => 'admin.bannable_search',
	'middleware' =>['auth:admin'],
]);


Route::get('/admin/settings', [
	'uses' => '\Faf\Http\Controllers\AdminController@getAdminSettings',
	'as' => 'admin.adminSettings',
	'middleware' => ['auth:admin'],

]);


Route::post('/admin/reports/{userId}/delete',[
	'uses' => '\Faf\Http\Controllers\AdminController@adminDeleteOptions',
	'as'=> 'admin.deleteOptions',
	'middleware' =>'auth:admin',

]);


Route::get('/admin/reports/{bannableId}/delete',[
	'uses' => '\Faf\Http\Controllers\AdminController@delBannablePost',
	'as'=> 'admin.bannablePost',
	'middleware' => 'auth:admin',
]);

Route::get('/admin/reports/{bannableId}/delete_post',[

	'uses' => '\Faf\Http\Controllers\AdminController@delBannablePostTimeline',
	'as' => 'admin.bannablePostInTimeline',
	'middleware' => 'auth:admin',
]);


