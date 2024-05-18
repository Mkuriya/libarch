<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    
    public function fileUpload(Request $request){
        $validated = $request->validate([
            "title" => 'required',
            "year" => 'required|max:4',
            "members" => 'required',
            "abstract" => 'required',
            "banner" => 'required|mimes:png,jpg,jpeg|max:2048',
            'document' => 'required|mimes:pdf|max:2048',
            'student_id' => 'required',
        ]);
      
        $imageName = time().$request->file('banner')->getClientOriginalName();
        $fileName = time().$request->file('document')->getClientOriginalName();
        $path = $request->file('banner')->storeAs('images', $imageName, 'public'); 
        $paths = $request->file('document')->storeAs('document', $fileName, 'public'); 
        $validated["banner"] = '/storage/'.$path;
        $validated["document"] = '/storage/'.$paths;
        $upload = File::create($validated);
        return redirect('/student/dashboard');
    }
}
