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
// TEST
Route::view('/test', 'group.add')->name('test');


// HOME
//Route::view('/', 'welcome')->name('home');
Route::get('/', 'UserController@home')->name('home');

// DASHBOARD
//Route::view('/main', 'mainpage')->middleware('loggedin')->name('main');

// GUEST
Route::get('/guest', 'PostController@posts')->name('guest');

// USER
Route::post('/register', 'UserController@register')->name('register');
Route::post('/login', 'UserController@login')->name('login');
Route::get('/logout', 'UserController@logout')->name('logout');


// GROUP
Route::get('/group', 'GroupController@groups')->name('groups');
Route::get('/group/info/{id}', 'AjaxController@groups')->name('grouptest');
Route::view('/group/create', 'group.create')->name('groups.create')->middleware('teacher');
Route::post('/group/create/new', 'GroupController@new')->name('groups.new')->middleware('teacher');
Route::get('/group/add/{id}/{uid}', 'GroupController@addto')->name('groups.addto')->middleware('teacher');
Route::get('/group/add/{id}', 'GroupController@add')->name('groups.add')->middleware('teacher');
Route::post('/group/save/{id}', 'GroupController@postadd')->name('groups.postadd')->middleware('teacher');

// POST
Route::get('/main', 'PostController@posts')->name('main')->middleware('loggedin');
Route::view('/main/post', 'post.create')->name('createpost')->middleware('teacher');
Route::post('/main/post/add', 'PostController@add')->name('addpost')->middleware('teacher');

// MESSAGE
Route::get('/message', 'MessageController@messages')->name('messages')->middleware('loggedin');
Route::get('/message/create', 'MessageController@create')->name('message.create')->middleware('teacher');
Route::get('/message/add/{id}', 'MessageController@add')->name('message.add')->middleware('teacher');
Route::post('/message/postadd', 'MessageController@postadd')->name('message.postadd')->middleware('teacher');
Route::get('/message/read/{id}', 'MessageController@read')->name('message.read')->middleware('loggedin');

Route::get('/message/x/{id}', 'AjaxController@messages')->name('message.read')->middleware('loggedin');


// SEARCH
Route::get('/ajax/search', 'AjaxController@search')->name('search');
Route::get('/ajax/searchuser', 'AjaxController@searchuser')->name('searchuser');

// FILES
Route::get('/file', 'FileController@filelist')->name('files');
