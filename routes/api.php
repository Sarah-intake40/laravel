<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//---------------default route for api : -> for mobile apps
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//----------------this route to view all posts with auth
Route::get('/posts','Api\PostController@index')->middleware('auth:sanctum');

//-----------------this route to view one post details
Route::get('/posts/{post}','Api\PostController@show')->middleware('auth:sanctum');

//-------------------this route to store new post
Route::post('/posts','Api\PostController@store')->middleware('auth:sanctum');

//---------this route to generate token for user depends on email ,password,device_name
Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});

