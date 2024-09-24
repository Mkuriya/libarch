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

    public function detailsUpdate(File $file, Request $request){
        $data = $request->validate([
            'title' => 'required',
            'abstract' => 'required',
            'description' => 'required',
        ]);
        $data['description'] = strip_tags($data['description']);
        $data['abstract'] = strip_tags($data['abstract']);
        $data['title'] = strip_tags($data['title']);
        $file->update($data);
        return redirect()->back()->with('Success', 'File update successfully!');
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
        // Validate the input data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|digits:4',
            'members' => 'required|string',
            'abstract' => 'required|string',
            'description' => 'required|string',
            'document' => 'required|mimes:pdf|max:5120',  // 5MB max file size
            'student_lastname' => 'required|string|max:255',
            'student_firstname' => 'required|string|max:255',
            'student_department' => 'required|string|max:255',
            'citation' => 'required|string',
            'studentid' => 'required',
            'status' => 'required',  // Adjust status options as needed
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $path = $file->store('documents', 'public');  // Store in the 'documents' folder in 'public' disk
                $validated['document'] = $path;
            } else {
                return back()->with('error', 'No file was uploaded.');
            }

            // Save validated data to the database
            $upload = File::create($validated);  // Ensure the 'File' model is being referenced correctly
            
            return redirect('/student/dashboard')->with('success', 'File uploaded successfully!');
        } catch (\Exception $e) {
            // Handle exceptions and show error messages
            return back()->with('error', 'An error occurred during file upload: ' . $e->getMessage());
        }
    }


}
