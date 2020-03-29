<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
//-------------------------here to apply auth to all routes
Route::group(['middleware'=>['auth']],function (){
//---------------------this is the index page to show all posts
Route::get('/posts','PostController@index')->name('posts.index');//

//-----------------------this to create and store post
Route::get('/posts/create','PostController@create')->name('posts.create');//

//----------------------this to view One post details 
Route::get('/posts/{post}','PostController@show')->name('posts.show');//

//----------------------this for submitting and store to db
Route::post('/posts','PostController@store')->name('posts.store');//

//----------------------this to delete post
Route::get('/posts/{post}/delete','PostController@destroy')->name('posts.destroy');

//---------------------this to update post details
Route::put('/posts/{post}','PostController@update')->name('posts.update');//

//---------------------this to edit el post details
Route::get('/posts/{post}/edit','PostController@edit')->name('posts.edit');//
});
//---------------added by framework for auth with routes
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//-----------------------login with github
Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');