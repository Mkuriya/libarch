<?php

use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AdminController;
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
Route::get('/register', function(){
    return view('/register');
});
Route::get('/home', [ViewController::class, 'index'])->name('home'); // for display when the authentication is functioning
Route::get('/', function(){return view('home');});
//->name('admin.register')->middleware('auth:admin')
Route::get('/admin/dashboard/admin/register', [AdminController::class, 'register']); // to display the admin register 
Route::get('/admin/login', [AdminController::class, 'login']); // to display the admin login 

Route::post('/admin/register', [AdminController::class, 'adminRegister']); //for registration process
Route::post('/admin/loginprocess', [AdminController::class, 'adminLogin']); //for login process
Route::post('/admin/logout', [AdminController::class, 'adminLogout']); //for logout process

Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('auth:admin'); //for display the dashboard
Route::get('/admin/dashboard/student/register', [AdminController::class, 'adminDashboardStudent'])->name('student.register')->middleware('auth:admin'); //for display the dashboard

Route::get('/student/login', [StudentController::class, 'login']); // to display the student login 
Route::post('/student/loginprocess', [StudentController::class, 'loginProcess']); // to process the student login 
Route::post('/admin/dashboard/studentregister', [StudentController::class, 'studentRegister'])->name('admin.studentregister')->middleware('auth:admin'); //for registration process
Route::post('/student/logout', [StudentController::class, 'studentLogout']); //for logout process

Route::get('/student/dashboard', [StudentController::class, 'studentDashboard'])->name('student.dashboard')->middleware('auth:student'); //for student dashboard with auth

Route::get('/admin/dashboard/admin',[ViewController::class, 'adminList'])->name('admin.admin')->middleware('auth:admin'); //to display the admin list
Route::get('/admin/dashboard/student',[ViewController::class, 'studentlist'])->name('admin.student')->middleware('auth:admin'); // to display the student list
Route::get('/admin/dashboard/admin/edit/{admin}',[ViewController::class, 'adminEdit'])->name('admin.adminedit')->middleware('auth:admin'); // for display the edit page 
Route::get('/admin/dashboard/admin/view/{admin}',[ViewController::class, 'adminView'])->name('admin.adminview')->middleware('auth:admin'); // to display the admin details
Route::put('/admin/dashboard/admin/edit/{admin}', [ViewController::class, 'adminUpdate'])->name('admin.update')->middleware('auth:admin'); //to update the data from database
Route::delete('/admin/dashboard/admin/delete/{admin}', [ViewController::class, 'adminDelete'])->name('admin.delete')->middleware('auth:admin'); //to delete the data from database
Route::get('/admin/dashboard/admin/profile/{admin}',[ViewController::class, 'adminprofileView'])->name('admin.adminprofile')->middleware('auth:admin'); // to display the admin profile details
Route::get('/student/dashboard/student/profile/{student}',[ViewController::class, 'studentprofileView'])->name('admin.studentprofile')->middleware('auth:student'); // to display the admin profile details

Route::get('/admin/dashboard/student/view/{student}',[ViewController::class, 'studentView']); // to display the student details
Route::get('/admin/dashboard/student/edit/{student}',[ViewController::class, 'studentEdit']); // for display the edit page 
Route::delete('/admin/dashboard/student/delete/{student}', [ViewController::class, 'studentDelete']); //to delete the data from database
Route::put('/admin/dashboard/student/edit/{student}', [ViewController::class, 'studentUpdate']); //to update the data from database

Route::get('/admin/dashboard/archive', [ViewController::class, 'adminArchiveList']);

Route::put('/admin/dashboard/profile/edit/{admin}', [ViewController::class, 'adminProfile'])->name('admin.update')->middleware('auth:admin'); // for edit profile
Route::get('/admin/dashboard/profile/{admin}',[ViewController::class, 'adminprofileView'])->name('admin.adminprofile')->middleware('auth:admin'); // for display the profile
Route::get('/student/dashboard/upload',[ViewController::class, 'studentUpload'])->name('student.studentUpload')->middleware('auth:student'); // for display the upload form
Route::get('/student/dashboard/profile/{student}',[ViewController::class, 'studentprofileView'])->name('student.studentprofile')->middleware('auth:student'); // to display the stuident profile details

Route::put('/student/dashboard/profile/edit/{student}', [ViewController::class, 'studentProfile'])->name('student.update')->middleware('auth:student'); // for edit profile
Route::post('/student/dashboard/upload/file', [FileController::class, 'fileUpload']); // for edit profile