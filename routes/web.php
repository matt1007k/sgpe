<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login', 301);

Auth::routes();

Route::get('/success-register', function () {
    return view('client.messages.success-register');
});

Route::group(['namespace' => 'Client', ['middleware' => ['auth']]], function () {
    Route::get('/payments', 'PageController@index')->name('client.payments');

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile/{user}/update', 'ProfileController@update')->name('profile.update');
});
