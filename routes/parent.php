<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| parent Routes
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ], function () {

    //==============================dashboard============================
    Route::get('/parent/dashboard', function () {
        $sons = \App\Models\Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parents.dashboard',compact('sons'));
    })->name('dashboard.parents');

    Route::group(['namespace' => 'Parents\dashboard'], function () {
        Route::get('children', [App\Http\Controllers\Parents\dashboard\ChildrenController::class, 'index'])->name('sons.index');
        Route::get('results/{id}', [App\Http\Controllers\Parents\dashboard\ChildrenController::class, 'results'])->name('sons.results');

    });



//    Route::group(['namespace' => 'Students\dashboard'], function () {
//        Route::resource('student_exams', 'ExamsController');
//        Route::resource('profile-student', 'ProfileController');
//    });

});
