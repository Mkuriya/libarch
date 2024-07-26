@include('partials.studentnav')
@if ($errors->any())
    <!-- Modal overlay -->
    <div id="errorModalOverlay" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
        <!-- Modal structure -->
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/3">
            <div class="flex justify-between items-center bg-red-500 text-white text-xl p-4 rounded-t-lg">
                <h5 class="font-bold">Errors</h5>
                <button id="closeErrorModal" class="text-2xl leading-none">&times;</button>
            </div>
            <div class="p-4">
                <div class="text-red-700">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="flex justify-end p-4">
                <button id="closeErrorModalBtn" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">Close</button>
            </div>
        </div>
    </div>

    <!-- Script to handle modal closing -->
    <script type="text/javascript">
        document.getElementById('closeErrorModal').onclick = function() {
            document.getElementById('errorModalOverlay').style.display = 'none';
        };
        document.getElementById('closeErrorModalBtn').onclick = function() {
            document.getElementById('errorModalOverlay').style.display = 'none';
        };
    </script>
@endif

<section class="max-w-5xl pt-6 px-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 sm:mt-4 mt-0">
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Upload Thesis</h1>
    <form action="/student/dashboard/upload/file" method="POST"enctype="multipart/form-data" >
        @csrf
        <div class="mt-4">
            <label for="" class="text-white dark:text-gray-200">Title</label>
            <input type="text" name="title" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white ">
            @error('title'){{$message}}@enderror
        </div>
        <div class="mt-4">
            <label for="" class="text-white dark:text-gray-200">Year</label>
            <input min="1900" max="2099" step="1" value="2024" name="year"type="number" class="hide-arrows block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white  no-spinner" />
        </div>
        <div class="mt-4">
            <label for="" class="text-white dark:text-gray-200">Members</label>
            <input type="text" name="members" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white ">
        </div>
        <br>
        <div>
            <label for="" class="text-white dark:text-gray-200">Abstract</label>
            <textarea name="abstract" id="" cols="0" rows="6" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white "></textarea>
          
        </div>
        <div>
            <input type="hidden" value="{{auth()->guard('student')->user()->id}}" name="student_id">
            <input type="hidden" value="0" name="status">
        </div>
        <div class="mt-2">
            <label for="" class="text-white dark:text-gray-200">
                File
                <span class="text-sm text-gray-400">(PDF ONLY, Limit: 5MB)</span>
            </label>
            <input type="file" name="document" accept="application/pdf" class="block w-full mt-2 px-2 py-2 bg-gray-800 border border-gray-600 rounded-md text-white file:py-1 file:px-2 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-transparent file:text-white hover:file:bg-gray-700 hover:bg-gray-700">
        </div>
        

    
        <div class="flex justify-center  py-4">
            <button type="submit" class=" px-16 py-2 leading-5 text-white transition-colors duration-200 transform bg-whitebg rounded-md
             hover:bg-gray-700 focus:outline-none focus:bg-gray-600">Save
            </button>
             <a href="/student/dashboard">
                <button type="button" class="ml-10 px-16 py-2 leading-5 text-white transition-colors duration-200 transform bg-whitebg rounded-md 
                hover:bg-gray-700 focus:outline-none focus:bg-gray-600">Back
                </button>
            </a>
        </div>
    </form>
    
</section>

@extends('partials.footer')