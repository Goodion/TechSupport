<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'AppealsController@index');
Route::post('/appeal_close/{appeal}', 'AppealsController@close');
Route::resource('appeals', 'AppealsController');

Auth::routes();
/*
Route::get('/home', 'HomeController@index')->name('home');*/
