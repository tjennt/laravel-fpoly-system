<?php

use Illuminate\Support\Facades\Route;

// ROUTE LOGIN
Route::get('login', 'Users\Login@getView')->name('login');
Route::post('login', 'Users\Login@login');
Route::post('logout', 'Users\Login@logout')->name('logout');

