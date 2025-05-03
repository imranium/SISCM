<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/check-auth', function () {
    return Auth::check() ? 'Authenticated as ' . Auth::user()->email : 'Not Authenticated';
});


Route::group(['middleware' => 'auth'], function () { 
    Route::resource('student', App\Http\Controllers\StudentController::class); 
    Route::resource('lecturer', App\Http\Controllers\LecturerController::class); 
    Route::resource('subject', App\Http\Controllers\SubjectController::class);
    
    //Route::resource('mark', App\Http\Controllers\MarkController::class);
    //Route::resource('assessment', App\Http\Controllers\AssessmentController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/subjects/{subject}/assessments', [App\Http\Controllers\AssessmentController::class, 'index'])->name('assessment.index');
    Route::get('/subjects/{subject}/assessments/create', [App\Http\Controllers\AssessmentController::class, 'create'])->name('assessment.create');
    Route::post('/subjects/{subject}/assessments', [App\Http\Controllers\AssessmentController::class, 'store'])->name('assessment.store');

    Route::get('/assessments/{assessment}', [App\Http\Controllers\AssessmentController::class, 'show'])->name('assessment.show');
    Route::get('/assessments/{assessment}/edit', [App\Http\Controllers\AssessmentController::class, 'edit'])->name('assessment.edit');
    Route::put('/assessments/{assessment}', [App\Http\Controllers\AssessmentController::class, 'update'])->name('assessment.update');
    Route::delete('/assessments/{assessment}', [App\Http\Controllers\AssessmentController::class, 'destroy'])->name('assessment.destroy');

    Route::get('/assessments/{assessment}/marks', [App\Http\Controllers\MarkController::class, 'index'])->name('mark.index');
    Route::get('/assessments/{assessment}/marks/create', [App\Http\Controllers\MarkController::class, 'create'])->name('mark.create');
    Route::post('/assessments/{assessment}/marks', [App\Http\Controllers\MarkController::class, 'store'])->name('mark.store');
    Route::get('/assessments/{assessment}/marks/{student}/edit', [App\Http\Controllers\MarkController::class, 'edit'])->name('mark.edit');
    Route::put('/assessments/{assessment}/marks/{student}', [App\Http\Controllers\MarkController::class, 'update'])->name('mark.update');
    Route::delete('/assessments/{assessment}/marks/{student}', [App\Http\Controllers\MarkController::class, 'destroy'])->name('mark.destroy');

    Route::get('/student/subjects', [App\Http\Controllers\StudentSubjectController::class, 'index'])->name('student.subjects');
    Route::get('/student/subjects/{subject}/assessments', [App\Http\Controllers\StudentSubjectController::class, 'showAssessments'])->name('student.subject.assessments');
});

