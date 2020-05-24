<?php

use Illuminate\Support\Facades\Route;


Route::get('users', 'Users\Get@users')->name('get-users');

Route::get('users/teachers', 'Users\Get@usersTeachers')->name('get-users-teachers');

Route::get('user/{uuid}', 'Users\Get@user')->name('get-user');

Route::get('create-teachers-excel', 'Users\CreateTeacher@teachersView')->name('create-teachers-excel');

Route::post('create-teachers-excel', 'Users\CreateTeacher@teachersPost')->name('create-teachers-excel-post');