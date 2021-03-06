<?php

use App\Http\Controllers\Teachers\dashboard\QuizzController;
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
        Route::get('attendance_report',  [App\Http\Controllers\Teachers\dashboard\StudentController::class, 'attendanceReport'])->name('attendance.report');
        Route::post('attendance_search',  [App\Http\Controllers\Teachers\dashboard\StudentController::class, 'attendanceSearch'])->name('attendance.search');

        Route::get('/indirect',  [App\Http\Controllers\Teachers\dashboard\OnlineZoomClassesController::class, 'indirectCreate'])->name('indirect.teacher.create');
        Route::get('/profile',  [App\Http\Controllers\Teachers\dashboard\ProfileController::class, 'index'])->name('profile.show');
        Route::post('/indirect',  [App\Http\Controllers\Teachers\dashboard\OnlineZoomClassesController::class, 'storeIndirect'])->name('indirect.teacher.store');
        Route::post('/profile/{id}',  [App\Http\Controllers\Teachers\dashboard\ProfileController::class, 'update'])->name('profile.update');

        Route::get('/student_quizze/{id}',  [App\Http\Controllers\Teachers\dashboard\QuizzController::class, 'student_quizze'])->name('student.quizze');
        Route::post('/repeat_quizze',  [App\Http\Controllers\Teachers\dashboard\QuizzController::class, 'repeat_quizze'])->name('repeat.quizze');


    });
    Route::resource('quizzes', QuizzController::class);
    Route::resource('questions', \App\Http\Controllers\Teachers\dashboard\QuestionController::class);
    Route::resource('online_zoom_classes', \App\Http\Controllers\Teachers\dashboard\OnlineZoomClassesController::class);
    Route::resource('online_zoom_classes', \App\Http\Controllers\Teachers\dashboard\OnlineZoomClassesController::class);

    });
