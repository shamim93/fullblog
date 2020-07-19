<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('frontend.index');
});
Route::get('about/', function () {
    return view('frontend.about');
});
Route::group(['prefix' => 'admin','middleware'=>['auth']], function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin');
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagController');
    Route::resource('posts', 'PostController');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


