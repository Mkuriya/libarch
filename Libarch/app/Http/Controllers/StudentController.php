<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function studentLogout(){
        Auth::guard('student')->logout();
        return redirect('/student/login');
    }

    public function studentDashboard(){
        return view('student.dashboard');
    }

    public function login(){
        return view('student.login');
    }
    public function loginProcess(Request $request){
        $input = $request->all();
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required|min:6'
        ]);
        if(auth()->guard('student')->attempt(['email' => $input['email'],'password' => $input['password']])){
            return redirect('/student/dashboard');
            $request->session()->regenerate();
            $student = auth()->guard('student')->user();
        } else{
            return redirect()->back()->with('error', 'Email and Password are not correct!');
        }
    }
    public function studentRegister(Request $request){
        $validated = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'middlename' => [''],
            'gender' => ['required'],
            'department' => ['required'],
            'email' => ['required',Rule::unique('students')],
            'password' => 'required|confirmed|min:6',
        ]) ;

        $validated['password'] = bcrypt($validated['password']);
        $fileName = time().$request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images', $fileName, 'public'); 
        $validated["photo"] = '/storage/'.$path;
        $student = Student::create($validated);
        return redirect('/admin/dashboard/student');
    }

    
}
