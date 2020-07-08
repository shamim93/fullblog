<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('frontend.index');
});
Route::get('about/', function () {
    return view('frontend.about');
});
Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard/', function () {
        return view('admin.index');
    });
    Route::resource('categories', 'CategoryController');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


