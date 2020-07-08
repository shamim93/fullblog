<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('frontend.index');
});
Route::get('about/', function () {
    return view('frontend.about');
});
Route::get('admin/', function () {
    return view('admin.index');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


