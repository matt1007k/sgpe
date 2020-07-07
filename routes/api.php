<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/people/{person}', 'PersonController@show')->name('api.v1.people.show');
Route::get('/people', 'PersonController@index')->name('api.v1.people.index');
Route::get('/verify-user', function () {

    $url = "http://localhost:8001/api/v1";
    $users = Http::get("$url/verify-user", ['q' => request('q')])->json();

    return $users;
});
