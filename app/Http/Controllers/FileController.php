<?php

namespace App\Http\Controllers;

use Log;
use App\Models\File;
use App\Models\History;
use App\Models\Student;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function destroy($id)
    {
        // Find the record by ID
        $record = History::findOrFail($id);
        
        // Check if the record belongs to the authenticated student
        if ($record->student_id == auth()->guard('student')->user()->id) {
            $record->delete();
            
        }
        
        return redirect()->back()->with('Success', 'History delete successfully!');
    }

    
    public function saveDocument(Request $request)
    {
            $validated = $request->validate([
                'student_id' => 'required|integer',
                'document_id' => 'required|integer',
            ]);
    
            // Save to the database
            History::create([
                'student_id' => $validated['student_id'],
                'document_id' => $validated['document_id'],
            ]);
    
            \Log::info('Document saved successfully'); // Log success
            return response()->json(['status' => 'success']);
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
