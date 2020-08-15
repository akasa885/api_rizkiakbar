<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('auth/register','Api\AuthController@register');
Route::post('auth/login','Api\AuthController@login');
Route::get('users','Api\UserController@users');
//maksud middleware(auth:api) adalah, kita mencek sebagai driver auth api, yang
//dimana providernya adalah eloquent users (bisa dilihat di config auth.php)
Route::get('users/profile','Api\UserController@profile')->middleware('auth:api');
Route::post('post','Api\PostController@add')->middleware('auth:api');
Route::get('users/{id}','Api\UserController@profileById')->middleware('auth:api');
//perbedaan route this above and this bellow
//atas, mengirim value ke sebuah variable yang nantinya ditangkap oleh variable
//tidak terinisialisasi di method
//bawah, mengirim value langsung ke tabel DB apabila variabel penerima (method)
//sama dengan pengirim pada route
Route::put('post/{post}','PostController@update')->middleware('auth:api');
Route::delete('post/{post}','PostController@delete')->middleware('auth:api');
