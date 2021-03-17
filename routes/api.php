<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

// create a user route
Route::get('/user-create', function(Request $request){
    App\Models\User::create([
        'name' => 'Benas on Code',
        'email' => 'benas@gmail.com',
        'password'=> Hash::make('benas123')
    ]);
});

// login a user
Route::post('login', function(){
    $credentials= request()->only(['email', 'password']);
    $token = auth()->attempt($credentials);
    return $token;
});
// get the authenticated user
Route::middleware('auth')->get('/me', function(){
    $user = auth()->user();

    return $user;
    //return $user->id;
});


// logout a user



// auth()->user();

// // server side authentication way
// - user visits browser
// - user logs in with with from browser
// - laravel keeps user auth info (session)

// // api side way
// - user visits browser
// - user logs in with form 

// - laravel authenticates user and gives a token (JWT)
// - user requests info from api wtih JWT


// - HTTP header Authorization