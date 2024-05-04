<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;

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

Route::get('/admin/dashboard', function(){
    return view('/admin/dashboard');
});



Route::get('/student/login', [StudentController::class, 'login'])->name('student.login'); //for display login form
Route::post('/studentlogin', [StudentController::class, 'studentlogin'])->name('student.login'); //to get the value of login form 

Route::get('/admin/login', [AdminController::class, 'login']); //for display login form
Route::get('/admin/dashboard/logout', [AdminController::class, 'logout']); //for logout form
Route::post('/adminlogin', [AdminController::class, 'adminlogin'])->name('admin.login'); //to get the value of login form 


Route::get('/student/dashboard/', [StudentController::class, 'showw']);
Route::get('/student/dashboard/logout', [StudentController::class, 'logout']); //for logout form


Route::resource('/admin/student/', StudentController::class);
Route::resource('/admin/dashboard/studentlist', StudentController::class);
Route::resource('/admin/dashboard/studentlist/', StudentController::class);


Route::resource('/admin/dashboard/adminlist', AdminController::class);
Route::resource('/admin/dashboard/adminlist/', AdminController::class);
Route::resource('/admin', AdminController::class);
Route::resource('/student', StudentController::class);