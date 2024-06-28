<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Admin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ViewController extends Controller
{
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
    
    public function studentProfile(Student $student, Request $request){
        $datas = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'middlename' => [''],
            'gender' => ['required'],
            'email' => ['required'],
        ]);
        $datas['firstname'] = strip_tags($datas['firstname']);
        $datas['lastname'] = strip_tags($datas['lastname']);
        $datas['middlename'] = strip_tags($datas['middlename']);
        $datas['gender'] = strip_tags($datas['gender']);
        $datas['email'] = strip_tags($datas['email']);    
        $student->update($datas);
        return redirect('/student/dashboard');
    }
    public function studentUpdate(Student $student, Request $request){
        $datas = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'middlename' => [''],
            'gender' => ['required'],
            'email' => ['required'],
            'department' => ['required'],
        ]);
        $datas['firstname'] = strip_tags($datas['firstname']);
        $datas['lastname'] = strip_tags($datas['lastname']);
        $datas['middlename'] = strip_tags($datas['middlename']);
        $datas['gender'] = strip_tags($datas['gender']);
        $datas['email'] = strip_tags($datas['email']);
        $datas['department'] = strip_tags($datas['department']);     
        $student->update($datas);
        return redirect('/admin/dashboard/student');
    }

    public function studentDelete(Student $student){
        $student->delete();
        return redirect('/admin/dashboard/student');
    }
    public function studentEdit(Student $student){
        return view('accounts.editstudent', ['student' => $student]);
    }
    public function studentView(Student $student){
        return view('accounts.viewstudent', ['student' => $student]);
    }
    public function studentlist(){
        $datas = Student::all();
        return view('accounts.studentlist', ['student' => $datas    ]);
    }

    //for admin
    public function adminDelete(Admin $admin){
        
        $admin->delete();
        return redirect('/admin/dashboard/admin');
    }

    public function adminlist(){
        $data = Admin::all();
        return view('accounts.adminlist',['admin' => $data]);
    }
    public function adminProfile(Admin $admin, Request $request){
        $data = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'middlename' => [''],
            'gender' => ['required'],
            'email' => ['required'],
        ]);
        $data['firstname'] = strip_tags($data['firstname']);
        $data['lastname'] = strip_tags($data['lastname']);
        $data['middlename'] = strip_tags($data['middlename']);
        $data['gender'] = strip_tags($data['gender']);
        $data['email'] = strip_tags($data['email']);
            
        $admin->update($data);
        return redirect('/admin/dashboard');
    }
    public function adminUpdate(Admin $admin, Request $request){
        $data = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'middlename' => [''],
            'gender' => ['required'],
            'email' => ['required'],
        ]);
        $data['firstname'] = strip_tags($data['firstname']);
        $data['lastname'] = strip_tags($data['lastname']);
        $data['middlename'] = strip_tags($data['middlename']);
        $data['gender'] = strip_tags($data['gender']);
        $data['email'] = strip_tags($data['email']);
            
        $admin->update($data);
        return redirect('/admin/dashboard/admin');
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
