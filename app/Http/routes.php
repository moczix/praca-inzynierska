<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




Route::group(array('namespace' => 'Admin', 'middleware'=>'adminAuth', 'prefix'=>'admin'), function(){
	Route::get('panel', 'IndexAdminController@index');
	Route::get('members', 'IndexAdminController@members');
	Route::get('groups', 'IndexAdminController@groups');
	
	Route::post('addNewUser', 'IndexAdminController@addNewUser');
	Route::get('changeStatus/{id}', 'IndexAdminController@changeUserStatus')->where('id','[0-9]+');
	Route::post('addNewGroup', 'IndexAdminController@addNewGroup');
	Route::get('delGroup/{id}', 'IndexAdminController@delGroup')->where('id','[0-9]+');
	Route::post('chooseGroup', 'IndexAdminController@chooseGroup');
	Route::post('addJob', 'IndexAdminController@addJob');
	Route::get('changeJobStatus/{id}', 'IndexAdminController@changeJobStatus')->where('id','[0-9]+');
	Route::get('delJob/{id}', 'IndexAdminController@delJob')->where('id','[0-9]+');
	Route::post('editJob', 'IndexAdminController@editJob');
	
	Route::get('showHistory/{id}', 'IndexAdminController@showJobHistory')->where('id','[0-9]+');
	
	Route::get('getDetailsHistory/{id}', 'IndexAdminController@getHistory')->where('id','[0-9]+');
	
	
	Route::get('showUser/{id}', 'IndexAdminController@showUser')->where('id','[0-9]+');
	
	Route::post('changePSW', 'IndexAdminController@changePasswordUser');
	
	Route::get('delHistory/{id}', 'IndexAdminController@deleteHistory')->where('id','[0-9]+');
});


Route::group(array('namespace' => 'User', 'middleware'=>'userAuth', 'prefix'=>'user'), function(){
	
	Route::get('panel', 'IndexUserController@index');
	Route::get('doJob/{id}', 'IndexUserController@doJobPage')->where('id','[0-9]+');
	Route::post('completeJob', 'IndexUserController@completeJob');
	
});

Route::group(array('namespace' => 'Guest'), function(){
	Route::get('/', 'IndexGuestController@index');
	Route::get('activate/{code}',  'IndexGuestController@activateAccount');
	
	Route::post('register',  'IndexGuestController@register');
	Route::post('login',  'IndexGuestController@login');
	
	Route::get('logout',   'IndexGuestController@logout');
	
	
});