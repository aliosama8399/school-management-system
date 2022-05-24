<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ajax Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
//*/

Route::group([ 'prefix' => LaravelLocalization::setLocale(),
    'middleware' => 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher,web'], function () {

Route::get('/Get_classrooms/{id}', [App\Http\Controllers\AjaxController::class, 'Get_classrooms'])->name('Get_classrooms');
Route::get('/Get_Sections/{id}', [App\Http\Controllers\AjaxController::class, 'Get_Sections'])->name('Get_Sections');

});
