<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/people/{person}', 'PersonController@show')->name('api.v1.people.show');
Route::get('/people', 'PersonController@index')->name('api.v1.people.index');

Route::get('/users/{user}', 'UserController@show')->name('api.v1.users.show');
Route::get('/messages/{message}', 'MessageController@show')->name('api.v1.messages.show');
// Route::get('/messages', 'MessageController@index')->name('api.v1.messages.index');


Route::get('/verify-user', function () {

    // $urlBase = 'http://localhost:8001/api/v1/';
    $urlBase = config('app.url_api');
    $users = Http::get("$urlBase/verify-user", ['q' => request('q')])->json();

    return $users;
});
