<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ViewController extends Controller
{
    public function decline(){
        $files = File::all();
        return view('archive.decline', ['file' => $files]);
    }
    public function studentLogin(){
        return view('student.login');
    }
    public function studentDashboard(){
        return view('student.dashboard');
    }
    public function studentArchiveList(){
        $data = File::all();
        return view('archive.archivelist',['file' => $data]);
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
    public function pending(){
        $data = File::all();
        return view('archive.pending', ['file' => $data]);
    }

    public function studentUpload(){
        return view('archive.upload');
    }
    public function adminArchiveList(){
        $data = File::all();
        return view('archive.list', ['file' => $data]);
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
    public function studentlist(Request $request)
    {
        $query = Student::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('firstname', 'LIKE', "%{$search}%")
                  ->orWhere('lastname', 'LIKE', "%{$search}%")
                  ->orWhere('middlename', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('department', 'LIKE', "%{$search}%");
        }

        $students = $query->paginate(2)->appends($request->except('page'));

        return view('accounts.studentlist', compact('students'));
    }
  /*  public function studentlist(){

        $datas = Student::paginate(2);
        return view('accounts.studentlist', ['student' => $datas    ]);
    }
*/
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
    public function adminlist(){
        $data = Admin::all();
        return view('accounts.adminlist',['admin' => $data]);
    }
   

    public function adminEdit(Admin $admin){
        return view('accounts.editadmin', ['admin' => $admin]);
    }
    public function adminView(Admin $admin){
        return view('accounts.viewadmin', ['admin' => $admin]);
    }

    //
    public function index()
    {
        return view('home');
    }
}
