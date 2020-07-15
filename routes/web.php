<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login', 301);

Auth::routes();

Route::get('/success-register', function () {
    return view('client.messages.success-register');
});

Route::get('/profile', function () {
    return view('client.profile.index');
})->name('profile')->middleware('auth');

Route::group(['namespace' => 'Client', ['middleware' => ['auth']]], function () {
    Route::get('/payments', 'PageController@index')->name('client.payments');
});
