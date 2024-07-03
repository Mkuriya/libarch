<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminDelete(Admin $admin){
        
        $admin->delete();
        return redirect('/admin/dashboard/admin');
    }
    public function studentDelete(Student $student){
        $student->delete();
        return redirect('/admin/dashboard/student');
    }
    public function resetPassword( Request $request){
        
    }
    public function updatePassword( Request $request){
            $request->validate([
            'old_password'=> 'required',
            'new_password'=> 'required',
        ]);
        if(!Hash::check($request->old_password, auth()->guard('admin')->user()->password)){
            return back()->with("error", "Old Password Doesn't Match");
        }
        Admin::whereId(auth()->guard('admin')->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return redirect()->back()->with("status", "Password Success Update");
        
    }
    public function adminLogout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
    public function studentUpdate(Student $student, Request $request){
        $datas = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'middlename' => [''],
            'gender' => ['required'],
            'email' => ['required'],
            'department' => ['required'],
            'password' => 'required|confirmed|min:8', // Add validation for password
        ]);
    
        // Sanitize input
        $datas['firstname'] = strip_tags($datas['firstname']);
        $datas['lastname'] = strip_tags($datas['lastname']);
        $datas['middlename'] = strip_tags($datas['middlename']);
        $datas['gender'] = strip_tags($datas['gender']);
        $datas['email'] = strip_tags($datas['email']);
        $datas['department'] = strip_tags($datas['department']);
    
        // Check if password is provided and hash it
        if (!empty($datas['password'])) {
            $datas['password'] = bcrypt($datas['password']);
        } else {
            unset($datas['password']); // Remove password key if not provided to avoid overwriting with null
        }
    
        $student->update($datas);
    
        return redirect('/admin/dashboard/student');
    }
    /*public function studentUpdate(Student $student, Request $request){
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
    }*/

    public function adminLogin(Request $request){
        $input = $request->all();
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);
        if(auth()->guard('admin')->attempt(['email' => $input['email'],'password' => $input['password']])){
            return redirect('/admin/dashboard');
            $request->session()->regenerate();
            $admin = auth()->guard('admin')->user();
        } else{
            return redirect()->back()->with('error', 'Email and Password are not correct!');
        }
    }

    public function adminRegister(Request $request){
        $validated = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'middlename' => [''],
            'gender' => ['required'],
            'email' => ['required',Rule::unique('admins')],
            'password' => 'required|confirmed|min:8',
            'photo' => [''],
        ]) ;

        $validated['password'] = bcrypt($validated['password']);
        $fileName = time().$request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images', $fileName, 'public'); 
        $validated["photo"] = '/storage/'.$path;
        $admin = Admin::create($validated);
        
        auth()->login($admin);
        return redirect('/admin/dashboard');
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
            'password' => 'required|confirmed|min:8', // Add validation for password
        ]);
        $data['firstname'] = strip_tags($data['firstname']);
        $data['lastname'] = strip_tags($data['lastname']);
        $data['middlename'] = strip_tags($data['middlename']);
        $data['gender'] = strip_tags($data['gender']);
        $data['email'] = strip_tags($data['email']);
             // Check if password is provided and hash it
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']); // Remove password key if not provided to avoid overwriting with null
        }
        $admin->update($data);
        return redirect('/admin/dashboard/admin');
    }
}
