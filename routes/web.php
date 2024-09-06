<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StudentController::class, 'showStudents'])->name('home');

Route::get('/student/{id}', [StudentController::class, 'singleStudent'])->name('view.student');

Route::post('insert/student', [StudentController::class, 'insertStudent'])->name('insert.student');

Route::put('update/student', [StudentController::class, 'update'])->name('update.student');

Route::get('delete/{id}', [StudentController::class, 'delete'])->name('delete.student');

Route::view('/newstudent', 'addStudent')->name('add.form');

Route::get('updatestudent/{id}', [StudentController::class, 'updateStudentPage'])->name('update.form');

Route::get('/users', [StudentController::class, 'union'])->name('union');

Route::get('/when', [StudentController::class, 'when'])->name('when');

Route::get('/chunk', [StudentController::class, 'chunk'])->name('chunk');