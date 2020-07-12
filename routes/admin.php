<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/api/v1/messages', 'MessageController@index')->name('api.v1.messages.index');
});
