<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
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
     return back()->with("status", "Password Success Update");
      
    } 

    public function register(){
        return view('admin.register');
    }

    public function login(){
        return view('admin.login');
    }

    public function adminDashboardStudent(){
        return view('student.register');
    }

    public function adminLogout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function adminDashboard(){
        return view('admin.dashboard');
    }

    public function adminLogin(Request $request){
        $input = $request->all();
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required|min:6'
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
            'password' => 'required|confirmed|min:6',
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
}
