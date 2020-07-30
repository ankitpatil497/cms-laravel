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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware(['auth'])->group(function () {
        
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/categories', 'CategoriesController');

    Route::resource('/tags','TagsController' );

    Route::resource('/posts', 'PostsController')->middleware('auth');

    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');

    Route::put('restore-posts/{post}', 'PostsController@restore')->name('restore-posts');
});

Route::middleware(['auth','admin'])->group(function(){
    Route::get('user/profile','UsersController@edit')->name('user.edit-profile');
    Route::put('user/profile/update', 'UsersController@update')->name('user.update-profile');
    Route::get('users','UsersController@index')->name('user.index');    
    Route::post('makeadmin/{users}','UsersController@makeAdmin')->name('makeadmin');
});
