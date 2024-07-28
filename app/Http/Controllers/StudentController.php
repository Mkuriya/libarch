<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function updatePassword( Request $request){
        $request->validate([
        'old_password'=> 'required',
        'new_password'=> 'required',
        'confirm_password'=> 'required',
    ]);
    if(!Hash::check($request->old_password, auth()->guard('student')->user()->password)){
        return back()->withErrors(['old_password' => "Password doesn't match"],['new_password' => "Password doesn't match"]);
    }
    Student::whereId(auth()->guard('student')->user()->id)->update([
        'password' => Hash::make($request->new_password)
    ]);
    return back()->with("success", "Password Success Update");
    
}
    
public function studentProfile(Student $student, Request $request){
    $datas = $request->validate([
        'firstname' => ['required'],
        'lastname' => ['required'],
        'middlename' => ['nullable'],
        'gender' => ['required'],
       // 'email' => ['required', 'email'],
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Validate photo
    ]);

    // Sanitize input
    $datas['firstname'] = strip_tags($datas['firstname']);
    $datas['lastname'] = strip_tags($datas['lastname']);
    $datas['middlename'] = strip_tags($datas['middlename']);
    $datas['gender'] = strip_tags($datas['gender']);
   // $datas['email'] = strip_tags($datas['email']); 

    // Check if a photo is uploaded
    if ($request->hasFile('photo')) {
        // Delete the old photo if it exists
        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }
        
        // Store new photo
        $photoPath = $request->file('photo')->store('images', 'public'); // Store photo in 'images' directory in the 'public' disk
        $datas['photo'] = $photoPath; // Update photo path in data
    }

    // Update student with sanitized and validated data
    $student->update($datas);

    return redirect()->back()->with('success', 'Your profile has been updated successfully.');
}

   
    public function studentLogout(){
        Auth::guard('student')->logout();
        return redirect('/student/login');
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
            'middlename' => ['nullable'],
            'gender' => ['required'],
            'department' => ['required'],
            'studentnumber' => ['required',Rule::unique('students')],
            'email' => ['required', Rule::unique('students')],
            'password' => 'required|confirmed|min:8',
            'photo'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Handle the photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('images', 'public');
            $validated['photo'] = $path;
        } else {
            // Set the default image path if no photo is uploaded
            $validated['photo'] = 'img/profile.jpg'; // Ensure this path is correct and the image exists
        }
    
        // Create the student with the validated data and the image path
        $validated['password'] = bcrypt($validated['password']); // Hash the password
        $student = Student::create($validated);
    
        return redirect('/admin/dashboard/student');
    }
    

    
}
