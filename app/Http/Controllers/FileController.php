<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Student;
use Illuminate\Http\Request;

class FileController extends Controller
{
    // In AbstractController.php
    public function searchAbstract(Request $request)
    {
        $query = $request->input('query');
        $abstracts = File::where('status', 1)  // Add this line to filter by status
            ->where('abstract', 'like', "%{$query}%")
            ->get(['abstract', 'document']); // Ensure 'document' is included if you need it
        
        return response()->json($abstracts);
    }



    public function search(Request $request){

        $search = $request->search;
        $student=Student::where(function($query) use ($search){
            $query->where('lastname','like', "%$search%")
            ->orWhere('firstname', 'like', "%$search%");
        })
        
        ->get();
         return view('accounts.studentlist', compact('student', 'search'));
    }

    public function fileUpdate(File $file, Request $request){
        $data = $request->validate([
            'status' => 'required'
        ]);
        $data['status'] = strip_tags($data['status']);
        $file->update($data);
        return redirect()->back()->with('Success', 'File update successfully!');
    } 
    
    public function fileUpload(Request $request){
        $validated = $request->validate([
            "title" => 'required',
            "year" => 'required|max:4',
            "members" => 'required',
            "abstract" => 'required',
            'document' => 'required|mimes:pdf|max:5120',
            'student_lastname' => 'required',
            'student_firstname' => 'required',
            'student_department' => 'required',
            'citation' => 'required',
            'status' => 'required',
        ]);
   
        $fileName = time().$request->file('document')->getClientOriginalName();
        $paths = $request->file('document')->storeAs('document', $fileName, 'public'); 
        $validated["document"] = '/storage/'.$paths;


        $upload = File::create($validated);
        return redirect('/student/dashboard')->with('success', 'File uploaded successfully!');
    }
}
