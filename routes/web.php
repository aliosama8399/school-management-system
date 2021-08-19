<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('auth.login');
    });

});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () { //...

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('Grades', \App\Http\Controllers\Grades\GradeController::class);
    Route::post('/delete_all_grades', [App\Http\Controllers\Grades\GradeController::class, 'delete_all_grades'])->name('delete_all_grades');

    Route::resource('Classrooms', \App\Http\Controllers\Classrooms\ClassroomController::class);
    Route::post('delete_all', [App\Http\Controllers\Classrooms\ClassroomController::class, 'delete_all'])->name('delete_all');
    Route::post('Filter_Classes', [App\Http\Controllers\Classrooms\ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');

});


