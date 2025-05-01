<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('students', App\Http\Controllers\StudentController::class);
Route::resource('lecturers', App\Http\Controllers\LecturerController::class);
Route::resource('subjects', App\Http\Controllers\SubjectController::class);