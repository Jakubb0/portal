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
Route::view('/', 'welcome')->name('home');

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

//SEARCH
Route::get('/ajax/search', 'AjaxController@search')->name('search');
