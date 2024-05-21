<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function fileUpdate(File $file){
        return view('archive.edit', ['file' => $file]);
    }

    public function fileUpdateStatus(File $file, Request $request){
        $data = $request->validate([
            'status' => ['required'],
           
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
            "banner" => 'required|mimes:png,jpg,jpeg|max:2048',
            'document' => 'required|mimes:pdf|max:2048',
            'student_id' => 'required',
            'status' => 'required',
        ]);
      
        $imageName = time().$request->file('banner')->getClientOriginalName();
        $path = $request->file('banner')->storeAs('images', $imageName, 'public'); 
        $validated["banner"] = '/storage/'.$path;

        $fileName = time().$request->file('document')->getClientOriginalName();
        $paths = $request->file('document')->storeAs('document', $fileName, 'public'); 
        $validated["document"] = '/storage/'.$paths;


        $upload = File::create($validated);
        return redirect('/student/dashboard');
    }
}
