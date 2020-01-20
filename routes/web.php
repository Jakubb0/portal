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


// HOME
Route::get('/', 'UserController@home')->name('home');


// GUEST
Route::get('/guest', 'PostController@posts')->name('guest');

// USER
Route::post('/register', 'UserController@register')->name('register');
Route::post('/login', 'UserController@login')->name('login');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::get('/users', 'UserController@users')->name('users')->middleware('admin'); 
Route::get('/userprofile', 'UserController@profile')->name('profile')->middleware('loggedin'); 
Route::view('/userprofile/edit', 'users.editprofile')->name('profile.edit')->middleware('loggedin'); 
Route::post('/changerole/{id}', 'UserController@changerole')->name('changerole')->middleware('admin'); 
Route::get('/users/delete/{id}', 'UserController@delete')->name('user.delete')->middleware('admin'); 


// GROUP
Route::get('/group', 'GroupController@groups')->name('groups');
Route::view('/group/create', 'group.create')->name('groups.create')->middleware('teacher');
Route::post('/group/create/new', 'GroupController@new')->name('groups.new')->middleware('teacher');
Route::get('/group/add/{id}', 'GroupController@add')->name('groups.add')->middleware('teacher');
Route::post('/group/save/{id}', 'GroupController@postadd')->name('groups.postadd')->middleware('teacher');

// POST
Route::get('/main', 'PostController@posts')->name('main')->middleware('loggedin');
Route::view('/main/post', 'post.create')->name('createpost')->middleware('teacher');
Route::post('/main/post/add', 'PostController@add')->name('addpost')->middleware('teacher');

// MESSAGE
Route::get('/message', 'MessageController@messages')->name('messages')->middleware('loggedin');
Route::get('/message/create', 'MessageController@create')->name('message.create')->middleware('teacher');
Route::post('/message/postadd', 'MessageController@postadd')->name('message.postadd')->middleware('teacher');
Route::get('/message/read/{id}', 'MessageController@read')->name('message.read')->middleware('loggedin');
Route::get('/message/reply/{id}', 'MessageController@reply')->name('reply')->middleware('loggedin');
Route::post('/message/postreply/{id}', 'MessageController@postreply')->name('message.postreply')->middleware('loggedin');




// FILES
Route::get('/file', 'FileController@filelist')->name('files');



Route::middleware('ajax')->group(function () { 
	Route::get('/post/filter/{id}', 'AjaxController@posts');
	Route::get('/users/x/{id}', 'AjaxController@users')->middleware('teacher'); // middleware admin 
	Route::get('/message/x/{id}', 'AjaxController@messages')->name('message.read')->middleware('loggedin');
	// SEARCH
	Route::get('/ajax/search{id}', 'AjaxController@search')->name('search');
	Route::get('/ajax/user/search', 'AjaxController@searchuser')->name('searchuser');
	//
	Route::get('/userinfo/{id}', 'AjaxController@userinfo')->name('userinfo')->middleware('teacher'); 
	Route::get('/group/info/{id}', 'AjaxController@groups')->name('grouptest');
	Route::get('/group/add/{id}/{uid}', 'GroupController@addto')->name('groups.addto')->middleware('teacher');
	Route::get('/message/add/{id}', 'MessageController@add')->name('message.add');
    
});