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

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('/start')->group(function(){
    Route::get('/',[\App\Http\Controllers\StartController::class,'index'])->name('start.index');
});


Route::prefix('/admins')->group(function(){
    Route::post('/loginAdmin',[\App\Http\Controllers\AdminController::class,'loginAdmin'])->name('admins.login');
    Route::get('/logoutAdmin',[\App\Http\Controllers\AdminController::class,'logoutAdmin'])->name('admins.logout');
    Route::get('/',[\App\Http\Controllers\AdminController::class,'index'])->name('admins.index');
    Route::get('/create',[\App\Http\Controllers\AdminController::class,'create'])->name('admins.create');
    Route::post('/create',[\App\Http\Controllers\AdminController::class,'store'])->name('admins.store');
    Route::get('{id}/edit',[\App\Http\Controllers\AdminController::class,'edit'])->name('admins.edit');
    Route::put('{id}/edit',[\App\Http\Controllers\AdminController::class,'update'])->name('admins.update');
    Route::delete('{id}/delete',[\App\Http\Controllers\AdminController::class,'destroy'])->name('admins.destroy');
});

Route::middleware('checkLoginAdmin')->prefix('/academic_years')->group(function(){
    Route::get('/',[\App\Http\Controllers\AcademicYearController::class,'index'])->name('academics.index');
    Route::get('/create',[\App\Http\Controllers\AcademicYearController::class,'create'])->name('academics.create');
    Route::post('/create',[\App\Http\Controllers\AcademicYearController::class,'store'])->name('academics.store');
    Route::get('{id}/edit',[\App\Http\Controllers\AcademicYearController::class,'edit'])->name('academics.edit');
    Route::put('{id}/edit',[\App\Http\Controllers\AcademicYearController::class,'update'])->name('academics.update');
    Route::delete('{id}/delete',[\App\Http\Controllers\AcademicYearController::class,'destroy'])->name('academics.destroy');
});

Route::middleware('checkLoginAdmin')->prefix('/majors')->group(function(){
    Route::get('/',[\App\Http\Controllers\MajorController::class,'index'])->name('majors.index');
    Route::get('/create',[\App\Http\Controllers\MajorController::class,'create'])->name('majors.create');
    Route::post('/create',[\App\Http\Controllers\MajorController::class,'store'])->name('majors.store');
    Route::get('{id}/edit',[\App\Http\Controllers\MajorController::class,'edit'])->name('majors.edit');
    Route::put('{id}/edit',[\App\Http\Controllers\MajorController::class,'update'])->name('majors.update');
    Route::delete('{id}/delete',[\App\Http\Controllers\MajorController::class,'destroy'])->name('majors.destroy');
});

Route::prefix('/accountants')->group(function(){
    Route::post('/loginAccountant',[\App\Http\Controllers\AccountantController::class,'loginAccountant'])->name('accountants.login');
    Route::get('/logoutAccountant',[\App\Http\Controllers\AccountantController::class,'logoutAccountant'])->name('accountants.logout');
    Route::get('/',[\App\Http\Controllers\AccountantController::class,'index'])->name('accountants.index');
    Route::get('/create',[\App\Http\Controllers\AccountantController::class,'create'])->name('accountants.create');
    Route::post('/create',[\App\Http\Controllers\AccountantController::class,'store'])->name('accountants.store');
    Route::get('{id}/edit',[\App\Http\Controllers\AccountantController::class,'edit'])->name('accountants.edit');
    Route::put('{id}/edit',[\App\Http\Controllers\AccountantController::class,'update'])->name('accountants.update');
    Route::delete('{id}/delete',[\App\Http\Controllers\AccountantController::class,'destroy'])->name('accountants.destroy');
});

Route::middleware('checkLoginAdmin')->prefix('/scholarships')->group(function(){
    Route::get('/',[\App\Http\Controllers\ScholarshipController::class,'index'])->name('scholarships.index');
    Route::get('/create',[\App\Http\Controllers\ScholarshipController::class,'create'])->name('scholarships.create');
    Route::post('/create',[\App\Http\Controllers\ScholarshipController::class,'store'])->name('scholarships.store');
    Route::get('{id}/edit',[\App\Http\Controllers\ScholarshipController::class,'edit'])->name('scholarships.edit');
    Route::put('{id}/edit',[\App\Http\Controllers\ScholarshipController::class,'update'])->name('scholarships.update');
    Route::delete('{id}/delete',[\App\Http\Controllers\ScholarshipController::class,'destroy'])->name('scholarships.destroy');
});

Route::middleware('checkLoginAdmin')->prefix('/payment_methods')->group(function(){
    Route::get('/',[\App\Http\Controllers\PaymentMethodController::class,'index'])->name('payment_methods.index');
    Route::get('/create',[\App\Http\Controllers\PaymentMethodController::class,'create'])->name('payment_methods.create');
    Route::post('/create',[\App\Http\Controllers\PaymentMethodController::class,'store'])->name('payment_methods.store');
    Route::get('{id}/edit',[\App\Http\Controllers\PaymentMethodController::class,'edit'])->name('payment_methods.edit');
    Route::put('{id}/edit',[\App\Http\Controllers\PaymentMethodController::class,'update'])->name('payment_methods.update');
    Route::delete('{id}/delete',[\App\Http\Controllers\PaymentMethodController::class,'destroy'])->name('payment_methods.destroy');
});

Route::middleware('checkLoginAdmin')->prefix('/payment_types')->group(function(){
    Route::get('/',[\App\Http\Controllers\PaymentTypeController::class,'index'])->name('payment_types.index');
    Route::get('/create',[\App\Http\Controllers\PaymentTypeController::class,'create'])->name('payment_types.create');
    Route::post('/create',[\App\Http\Controllers\PaymentTypeController::class,'store'])->name('payment_types.store');
    Route::get('{id}/edit',[\App\Http\Controllers\PaymentTypeController::class,'edit'])->name('payment_types.edit');
    Route::put('{id}/edit',[\App\Http\Controllers\PaymentTypeController::class,'update'])->name('payment_types.update');
    Route::delete('{id}/delete',[\App\Http\Controllers\PaymentTypeController::class,'destroy'])->name('payment_types.destroy');
});
Route::middleware('checkLoginAdmin')->prefix('/study_classes')->group(function(){
    Route::get('/',[\App\Http\Controllers\StudyClassController::class,'index'])->name('study_classes.index');
    Route::get('/create',[\App\Http\Controllers\StudyClassController::class,'create'])->name('study_classes.create');
    Route::post('/create',[\App\Http\Controllers\StudyClassController::class,'store'])->name('study_classes.store');
    Route::get('{id}/edit',[\App\Http\Controllers\StudyClassController::class,'edit'])->name('study_classes.edit');
    Route::put('{id}/edit',[\App\Http\Controllers\StudyClassController::class,'update'])->name('study_classes.update');
    Route::delete('{id}/delete',[\App\Http\Controllers\StudyClassController::class,'destroy'])->name('study_classes.destroy');
});
Route::middleware('checkLoginAdmin')->prefix('/basic_fees')->group(function(){
    Route::get('/',[\App\Http\Controllers\BasicFeeController::class,'index'])->name('basic_fees.index');
    Route::get('/create',[\App\Http\Controllers\BasicFeeController::class,'create'])->name('basic_fees.create');
    Route::post('/create',[\App\Http\Controllers\BasicFeeController::class,'store'])->name('basic_fees.store');
    Route::get('{major_id}/{academic_id}/edit',[\App\Http\Controllers\BasicFeeController::class,'edit'])->name('basic_fees.edit');
    Route::put('{major_id}/{academic_id}/edit',[\App\Http\Controllers\BasicFeeController::class,'update'])->name('basic_fees.update');
    Route::delete('{major_id}/{academic_id}/delete',[\App\Http\Controllers\BasicFeeController::class,'destroy'])->name('basic_fees.destroy');
});
Route::middleware('checkLoginAdmin')->prefix('/students')->group(function(){
    Route::get('/',[\App\Http\Controllers\StudentController::class,'index'])->name('students.index');
    Route::get('{class_id}/create',[\App\Http\Controllers\StudentController::class,'create'])->name('students.create');
    Route::post('/create',[\App\Http\Controllers\StudentController::class,'store'])->name('students.store');
    Route::get('{id}/edit',[\App\Http\Controllers\StudentController::class,'edit'])->name('students.edit');
    Route::put('{id}/edit',[\App\Http\Controllers\StudentController::class,'update'])->name('students.update');
    Route::delete('{class_id}/{id}/delete',[\App\Http\Controllers\StudentController::class,'destroy'])->name('students.destroy');
    Route::get('/academics',[\App\Http\Controllers\StudentController::class,'classesList'])->name('students.academics');
    Route::get('{id}/classes',[\App\Http\Controllers\StudentController::class,'classFilter'])->name('students.classFilter');
    Route::get('{id}/students',[\App\Http\Controllers\StudentController::class,'studentFilter'])->name('students.studentFilter');


});
Route::middleware('checkLoginAccountant')->prefix('/receipts')->group(function(){
    Route::get('/',[\App\Http\Controllers\ReceiptController::class,'index'])->name('receipts.index');
    Route::get('{id}/create',[\App\Http\Controllers\ReceiptController::class,'create'])->name('receipts.create');
    Route::post('/store',[\App\Http\Controllers\ReceiptController::class,'store'])->name('receipts.store');
    Route::get('/{id}/export',[\App\Http\Controllers\ReceiptController::class,'export'])->name('receipts.export');
    Route::get('/students',[\App\Http\Controllers\ReceiptController::class,'studentsList'])->name('receipts.students');
    Route::get('/debtByQuarters',[\App\Http\Controllers\StudentController::class,'debtByQuarter'])->name('receipts.debtByQuarters');
    Route::get('/debtBySemesters',[\App\Http\Controllers\StudentController::class,'debtBySemester'])->name('receipts.debtBySemesters');
    Route::get('/debtByYears',[\App\Http\Controllers\StudentController::class,'debtByYear'])->name('receipts.debtByYears');
    Route::get('/classes',[\App\Http\Controllers\ReceiptController::class,'classesList'])->name('receipts.classes');
    Route::get('{id}/students',[\App\Http\Controllers\ReceiptController::class,'studentFilter'])->name('receipts.studentFilter');
    Route::get('/academics',[\App\Http\Controllers\ReceiptController::class,'classesList'])->name('receipts.academics');
    Route::get('{id}/classes',[\App\Http\Controllers\ReceiptController::class,'classFilter'])->name('receipts.classFilter');

});
    Route::get('/dashboards',[\App\Http\Controllers\DashboardController::class,'index'])->name('dashboards.index');

