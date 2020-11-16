<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('welcome');
});

Auth::routes();

Route::get('/success-register', function () {
    return view('client.messages.success-register');
});

Route::group(['namespace' => 'Client'], function () {
    Route::get('/payments', 'PageController@index')->name('client.payments');

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile/{user}/update', 'ProfileController@update')->name('profile.update');
    Route::get('/change-password/edit', 'ChangePasswordController@edit')->name('change-password.edit');
    Route::put('/change-password/{user}', 'ChangePasswordController@update')->name('change-password.update');
});
