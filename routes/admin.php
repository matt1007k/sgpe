<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('users', 'UserController');
    Route::post('/mark-verified/{dni}', 'UserController@markVerified');
    Route::get('/users-status', 'UserController@usersStatus');

    Route::resource('inboxes', 'InboxController')
        ->except(['show', 'create', 'edit', 'update']);

    Route::get('/api/v1/messages', 'MessageController@index')->name('api.v1.messages.index');
});
