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

    public function searchInPDF(Request $request)
{
    $query = $request->input('query');
    
    // Assuming you have a model `Document` and the PDF is stored as a BLOB
    $document = Document::find($request->input('document_id'));

    if (!$document || !$query) {
        return response()->json(['message' => 'Document or query not found'], 404);
    }

    // Fetch the PDF content
    $pdfContent = $document->pdf_content; // Replace `pdf_content` with your actual column name

    // Convert the PDF content to text
    $pdfText = $this->extractTextFromPDF($pdfContent);

    // Perform the search
    if (stripos($pdfText, $query) !== false) {
        return response()->json(['status' => 'found', 'pdfText' => $pdfText]);
    } else {
        return response()->json(['status' => 'not found']);
    }
}

private function extractTextFromPDF($pdfContent)
{
    // Use a package like Smalot/pdfparser to extract text from the PDF
    $parser = new \Smalot\PdfParser\Parser();
    $pdf = $parser->parseContent($pdfContent);
    $text = $pdf->getText();

    return $text;
}

}
