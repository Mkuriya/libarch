<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function fileUpdate(File $file, Request $request){
        $data = $request->validate([
            'status' => 'required'
        ]);
        $data['status'] = strip_tags($data['status']);
        $file->update($data);
        return redirect('/admin/dashboard/archive');
    } 
    
    public function fileUpload(Request $request){
        $validated = $request->validate([
            "title" => 'required',
            "year" => 'required|max:4',
            "members" => 'required',
            "abstract" => 'required',
            'document' => 'required|mimes:pdf|max:2048',
            'student_id' => 'required',
            'status' => 'required',
        ]);

        $fileName = time().$request->file('document')->getClientOriginalName();
        $paths = $request->file('document')->storeAs('document', $fileName, 'public'); 
        $validated["document"] = '/storage/'.$paths;


        $upload = File::create($validated);
        return redirect('/student/dashboard');
    }
}
