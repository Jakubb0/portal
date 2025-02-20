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
Route::get('/activateusers', 'UserController@activateusers')->name('activateusers')->middleware('admin'); 
Route::get('/userprofile', 'UserController@profile')->name('profile')->middleware('loggedin'); 
Route::get('/userprofile/edit', 'UserController@editprofile')->name('profile.edit')->middleware('loggedin'); 
Route::post('/userprofile/save', 'UserController@profilesave')->name('profile.save')->middleware('loggedin'); 
Route::post('/changerole/{id}', 'UserController@changerole')->name('changerole')->middleware('admin'); 
Route::get('/activate/{r}/{id}', 'UserController@activate')->name('user.activate')->middleware('admin'); 
Route::get('/users/delete/{id}', 'UserController@delete')->name('user.delete')->middleware('admin'); 


// GROUP
Route::get('/group', 'GroupController@groups')->name('groups');
Route::view('/group/create', 'group.create')->name('groups.create')->middleware('teacher');
Route::post('/group/create/new', 'GroupController@new')->name('groups.new')->middleware('teacher');
Route::get('/group/add/{id}', 'GroupController@add')->name('groups.add')->middleware('mygroup');
Route::get('/group/delete/{id}', 'GroupController@deletegroup')->name('groups.delete')->middleware('teacher');
Route::post('/group/save/{id}', 'GroupController@postadd')->name('groups.postadd')->middleware('teacher');
Route::post('/group/deletefrom/{gid}/{uid}', 'GroupController@deletefrom')->name('groups.deletefrom')->middleware('teacher');

// POST
Route::get('/main', 'PostController@posts')->name('main')->middleware('loggedin');
Route::view('/main/post', 'post.create')->name('createpost')->middleware('teacher');
Route::post('/main/post/add', 'PostController@add')->name('addpost')->middleware('teacher');
Route::get('/main/post/delete/{id}', 'PostController@delete')->name('deletepost')->middleware('teacher');

// MESSAGE
Route::get('/message', 'MessageController@messages')->name('messages')->middleware('loggedin');
Route::get('/message/create', 'MessageController@create')->name('message.create')->middleware('loggedin');
Route::post('/message/postadd', 'MessageController@postadd')->name('message.postadd')->middleware('loggedin');
Route::get('/message/delete/{id}', 'MessageController@delete')->name('message.delete')->middleware('loggedin');
Route::get('/message/reply/{type}/{id}', 'MessageController@reply')->name('reply')->middleware(['loggedin', 'replytest']);
Route::post('/message/postreply/{type}/{id}', 'MessageController@postreply')->name('message.postreply')->middleware('loggedin');




// FILES
Route::get('/file', 'FileController@filelist')->name('files');


// AJAX
	Route::get('/message/x/{id}', 'AjaxController@messages')->middleware('loggedin');
Route::middleware('ajax')->group(function () { 
	Route::get('group/clear/{id}', 'GroupController@clearusers')->middleware('teacher');
	Route::get('/post/filter/{id}', 'AjaxController@posts');
	Route::get('/message/read/{type}/{id}', 'MessageController@read')->middleware('loggedin');
	Route::get('/users/x/{id}', 'AjaxController@users')->middleware('admin');  
	Route::get('/ajax/search{id}', 'AjaxController@search')->name('search');
	Route::get('/ajax/user/search', 'AjaxController@searchuser')->name('searchuser');
	Route::get('/userinfo/{id}', 'AjaxController@userinfo')->name('userinfo')->middleware('teacher'); 
	Route::get('/message/add/{id}', 'MessageController@add')->name('message.add');
	Route::get('/group/info/{id}', 'AjaxController@groups')->name('grouptest');
	Route::get('/group/add/{id}/{uid}', 'GroupController@addto')->name('groups.addto')->middleware('teacher');
});