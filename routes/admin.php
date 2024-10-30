<?php

use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'admin', 'middleware'=>'auth:admin'], function() {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
});


Route::group(['namespace' => 'admin', 'middleware'=>'guest:admin'], function() {
    Route::get('login', 'LoginController@getLogin')->name('get.admin.login');
    Route::post('login', 'LoginController@login')->name('get.admin.login');
});
