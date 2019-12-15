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
Route::view('/', 'welcome')->name('home');

// DASHBOARD
Route::view('/main', 'mainpage')->middleware('loggedin')->name('main');

// USER
Route::post('/register', 'UserController@register')->name('register');
Route::post('/login', 'UserController@login')->name('login');
Route::get('/logout', 'UserController@logout')->name('logout');


// GROUP
Route::get('/group', 'GroupController@groups')->name('groups');
Route::view('/group/create', 'group.create')->name('groups.create')->middleware('teacher');
Route::post('/group/create/new', 'GroupController@new')->name('groups.new')->middleware('teacher');

// POST
Route::get('/post', 'PostController@posts')->name('posts');


