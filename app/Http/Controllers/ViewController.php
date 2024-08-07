<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ViewController extends Controller
{
    public function archivelistfilter(Request $request) {
        $query = File::query();
    
        // Apply search filter
        if ($request->has('search') && !empty($request->input('search'))) {
            $searchTerm = $request->input('search');
            $query->where(function($query) use ($searchTerm) {
                $query->where('title', 'like', '%' . $searchTerm . '%')
                      ->orWhere('year', 'like', '%' . $searchTerm . '%');
            });
        }
        if ($request->has('year') && !empty($request->input('year'))) {
            $query->where('year', $request->input('year'));
        }
        // Apply department filter
        if ($request->has('department') && !empty($request->input('department'))) {
            $department = $request->input('department');
            $query->whereHas('student', function($q) use ($department) {
                $q->where('department', $department);
            });
        }
    
        $files = $query->orderBy('title', 'asc')->paginate(7)->appends($request->except('page'));
        return view('archive.studentarchivefilter', compact('files'));
    }
    

    public function adminArchiveList(Request $request){
        $query = File::query();
    
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('year', 'LIKE', "%{$search}%");
        });
    }
    
    if ($request->input('status') == 0) {
        $query->where('status', 1);
    }
    if ($request->has('department') && !empty($request->input('department'))) {
        $department = $request->input('department');
        $query->whereHas('student', function($q) use ($department) {
            $q->where('department', $department);
        });
    }
    // Add sorting
    $query->orderBy('title', 'asc'); // or 'year', 'student->firstname', etc.
    
    // Paginate
    $files = $query->paginate(2)->appends($request->except('page'));
    
    return view('archive.list', compact('files'));
    }
    
    public function studentArchiveList(Request $request) {
        $query = File::query();
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('year', 'LIKE', "%{$search}%")
                  ->orWhere('abstract', 'LIKE', "%{$search}%");
            });
        }
    
        if ($request->input('status') == 0) {
            $query->where('status', 1);
        }
    
        // Add sorting
        $query->orderBy('title', 'asc'); // or 'year', 'student->firstname', etc.
    
        // Paginate and append query parameters except 'page'
        $files = $query->paginate(2)->appends($request->except('page'));
    
        return view('archive.archivelist', compact('files'));
    }
    
    public function pending(Request $request){
        $query = File::query();
        
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('year', 'LIKE', "%{$search}%");
            });
        }
    
        $status = $request->input('status');
        
        if ($status == 0) {
            $query->where('status', 0);
        }
        if ($request->has('department') && !empty($request->input('department'))) {
            $department = $request->input('department');
            $query->whereHas('student', function($q) use ($department) {
                $q->where('department', $department);
            });
        }
    
        $files = $query->paginate(1)->appends($request->except('page'));
    
        return view('archive.pending', compact('files'));
        
    }
    public function decline(Request $request){
        $query = File::query();
        
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('year', 'LIKE', "%{$search}%");
            });
        }
    
        if ($request->input('status') == 0) {
            $query->where('status', 2);
        }
        if ($request->has('department') && !empty($request->input('department'))) {
            $department = $request->input('department');
            $query->whereHas('student', function($q) use ($department) {
                $q->where('department', $department);
            });
        }
    
        // Add sorting
        $query->orderBy('title', 'asc'); // or 'year', 'student->firstname', etc.
    
        // Paginate
        $files = $query->paginate(2)->appends($request->except('page'));
    
        return view('archive.decline', compact('files'));
    }
    public function viewDocument(File $file){
        return view('archive.view', ['file' => $file]);
    }
    public function viewDoc(File $file){
        return view('archive.viewer', ['file' => $file]);
    }
    public function studentLogin(){
        return view('student.login');
    }
    public function studentDashboard(){
        return view('student.dashboard');
    }
        
    public function fileSearch(){
        return view('archive.search');
    }

    public function studentPassword(Student $student){
        return view('student.changepassword', ['student' => $student]);
    }
    public function adminPassword(Admin $admin){
        return view('admin.changepassword', ['admin' => $admin]);
    }
    
    public function studentUpload(){
        return view('archive.upload');
    }
    
    public function studentprofileView(Student $student){
        return view('accounts.studentprofile', ['student' => $student]);
    }
    public function adminprofileView(Admin $admin){
        return view('accounts.adminprofile', ['admin' => $admin]);
    }
    
    public function studentEdit(Student $student){
        return view('accounts.editstudent', ['student' => $student]);
    }
    public function studentView(Student $student){
        return view('accounts.viewstudent', ['student' => $student]);
    }
    public function filterstudentlist(Request $request){
        $query = Student::query();

        // Apply search filter
        if ($request->has('search') && !empty($request->input('search'))) {
            $searchTerm = $request->input('search');
            $query->where(function($query) use ($searchTerm) {
                $query->where('lastname', 'like', '%' . $searchTerm . '%')
                      ->orWhere('firstname', 'like', '%' . $searchTerm . '%')
                      ->orWhere('middlename', 'like', '%' . $searchTerm . '%')
                      ->orWhere('studentnumber', 'like', '%' . $searchTerm . '%');
            });
        }
        // Apply gender filter
        if ($request->has('gender') && !empty($request->input('gender'))) {
            $query->where('gender', $request->input('gender'));
        }

        // Apply department filter
        if ($request->has('department') && !empty($request->input('department'))) {
            $query->where('department', $request->input('department'));
        }

        $students = $query->orderBy('lastname', 'asc')->paginate(7)->appends($request->except('page'));
        return view('accounts.filterstudentlist', compact('students'));
    }
    public function studentlist(Request $request){
        $query = Student::query();
        
        $students = $query->orderBy('lastname', 'asc')->paginate(7)->appends($request->except('page'));
        return view('accounts.studentlist', compact('students'));
    }
 
    //for admin
    public function adminReset(){
        return view('accounts.resetadmin');
    }
  
    public function adminDashboard(){
        $totalUpload = File::where('status', 1)->count();
        $totalPending = File::where('status', 0)->count();
        
        $totalStudent = Student::count();
        return view('admin.dashboard',compact('totalUpload', 'totalStudent', 'totalPending' ));
    }
    public function register(){
        return view('admin.register');
    }
    public function adminLogin(){
        return view('admin.login');
    }
    public function adminDashboardStudent(){
        return view('student.register');
    }
    public function adminlist(Request $request){
        $query = Admin::query();
    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'LIKE', "%{$search}%")
                  ->orWhere('lastname', 'LIKE', "%{$search}%")
                  ->orWhere('middlename', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
    
        // Hide a specific account by its ID (e.g., ID = 123)
        $query->whereNotIn('id', [1, Auth::id()]); // Adjust 'id' to match your database schema
    
        // Paginate
        $admins = $query->orderBy('lastname', 'asc')->paginate(7)->appends($request->except('page'));
    
        return view('accounts.adminlist', compact('admins'));
    }
    public function adminEdit(Admin $admin){
        return view('accounts.editadmin', ['admin' => $admin]);
    }
    public function adminView(Admin $admin){
        return view('accounts.viewadmin', ['admin' => $admin]);
    }

    public function index()
    {
        return view('home');
    }
}
