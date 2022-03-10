<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teacher/dashboard', function () {

         $ids = \App\Models\Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
        $data['count_sections'] = $ids->count();
        $data['count_students'] = \App\Models\Student::whereIn('section_id', $ids)->count();

        return view('pages.Teachers.dashboard.dashboard',$data);
    });

    Route::group(['namespace' => 'Teachers\dashboard'], function () {
        //==============================students============================
        Route::get('student',  [App\Http\Controllers\Teachers\dashboard\StudentController::class, 'index'])->name('students.index');
        Route::get('sections',  [App\Http\Controllers\Teachers\dashboard\StudentController::class, 'sections'])->name('sections');
        Route::post('attendance',  [App\Http\Controllers\Teachers\dashboard\StudentController::class, 'attendance'])->name('attendance');
        Route::post('edit_attendance',  [App\Http\Controllers\Teachers\dashboard\StudentController::class, 'editAttendance'])->name('attendance.edit');

    });

    });
