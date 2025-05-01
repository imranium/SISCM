<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () { 
    Route::resource('student', App\Http\Controllers\StudentController::class); 
    Route::resource('lecturer', App\Http\Controllers\LecturerController::class); 
    Route::resource('subject', App\Http\Controllers\SubjectController::class); 
});
