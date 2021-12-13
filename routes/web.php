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
########################################################################################################################################################################
    Route::resource('Classrooms', \App\Http\Controllers\Classrooms\ClassroomController::class);
    Route::post('delete_all', [App\Http\Controllers\Classrooms\ClassroomController::class, 'delete_all'])->name('delete_all');
    Route::post('Filter_Classes', [App\Http\Controllers\Classrooms\ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');
#######################################################################################################################################################################
    Route::resource('Sections', \App\Http\Controllers\Sections\SectionController::class);
    Route::get('/classes/{id}', [App\Http\Controllers\Sections\SectionController::class, 'getclasses'])->name('getclasses');
################################################################################################################################################################
    Route::view('add_parent','livewire.show_Form');
#############################################################################################################################################################
    Route::resource('Teachers', \App\Http\Controllers\Teachers\TeacherController::class);
#################################################################################################################
    Route::resource('Students', \App\Http\Controllers\Students\StudentController::class);
    Route::get('/Get_classrooms/{id}', [App\Http\Controllers\Students\StudentController::class, 'Get_classrooms'])->name('Get_classrooms');
    Route::get('/Get_Sections/{id}', [App\Http\Controllers\Students\StudentController::class, 'Get_Sections'])->name('Get_Sections');
    Route::get('Download_attachment/{studentsname}/{filename}', [App\Http\Controllers\Students\StudentController::class, 'Download_attachment'])->name('Download_attachment');
    Route::post('Upload_attachment', [App\Http\Controllers\Students\StudentController::class, 'Upload_attachment'])->name('Upload_attachment');
    Route::post('Delete_attachment', [App\Http\Controllers\Students\StudentController::class, 'Delete_attachment'])->name('Delete_attachment');

    Route::resource('Promotion', \App\Http\Controllers\Students\PromotionController::class);
    Route::resource('Graduated', \App\Http\Controllers\Students\GraduatedController::class);
    Route::resource('Fees', \App\Http\Controllers\Students\FeesController::class);
    Route::resource('Fees_Invoices', \App\Http\Controllers\Students\FeesInvoicesController::class);
    Route::resource('receipt_students', \App\Http\Controllers\Students\ReceiptStudentsController::class);
    Route::resource('ProcessingFee', \App\Http\Controllers\Students\ProcessingFeeController::class);
    Route::resource('Payment_students', \App\Http\Controllers\Students\PaymentController::class);
    Route::resource('Attendance', \App\Http\Controllers\Students\AttendanceController::class);
    Route::resource('online_classes', \App\Http\Controllers\Students\OnlineClasseController::class);

    Route::get('/indirect',  [App\Http\Controllers\Students\OnlineClasseController::class, 'indirectCreate'])->name('indirect.create');
    Route::post('/indirect', [App\Http\Controllers\Students\OnlineClasseController::class, 'storeIndirect'])->name('indirect.store');
    ################################################################################################################################################################
    Route::resource('subjects', \App\Http\Controllers\Subjects\SubjectController::class);
#############################################################################################################################################################################
    Route::resource('Exams', \App\Http\Controllers\Exams\ExamController::class);
####################################################################################################################################
    Route::resource('Quizzes', \App\Http\Controllers\Quizzes\QuizzController::class);
 ##############################################################################################################################################
    Route::resource('questions', \App\Http\Controllers\questions\QuestionController::class);
    ##############################################################################################################################################




});


