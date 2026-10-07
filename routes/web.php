<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/about', 'pages.about')->name('about');
Route::view('/works', 'pages.works')->name('works');
Route::view('/admin', 'admin.admin')->name('admin');
