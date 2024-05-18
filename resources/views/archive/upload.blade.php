@include('partials.studentnav')
<section class="max-w-5xl pt-6 px-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-4">
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Upload Thesis</h1>
    <form action="/student/dashboard/upload/file" method="POST"enctype="multipart/form-data" >
        @csrf
        <div class="mt-4">
            <label for="" class="text-white dark:text-gray-200">Title</label>
            <input type="text" name="title" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            @error('title'){{$message}}@enderror
        </div>
        <div class="mt-4">
            <label for="" class="text-white dark:text-gray-200">Year</label>
            <input type="number" min="1900" max="2099" step="1" value="2024" name="year"class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" />
        </div>
        <div>
            <label for="" class="text-white dark:text-gray-200">Members</label>
            <input type="text" name="members" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
        </div>
        <br>
        <div>
            <label for="" class="text-white dark:text-gray-200">Abstract</label>
            <textarea name="abstract" id="" cols="50" rows="10" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"></textarea>
          
        </div>
        <div>
            <input type="hidden" value="{{auth()->guard('student')->user()->id}}" name="student_id">
        </div>
   

        <div>
            <label for="" class="text-white dark:text-gray-200">Book Cover</label>
            <input type="file" name="banner" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
        </div>
        <div>
            <label for="" class="text-white dark:text-gray-200">File (PDF ONLY)</label>
            <input type="file" name="document" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
        </div>

    
        <div class="flex justify-start mt-6">
            <button class=" px-16 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">Save</button>
         </div>
    </form>
    <div class="flex justify-end mt-6 ">
        <a href="/student/dashboard"><button class="relative bottom-16 px-16 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 
        rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">Cancel</button></a>
    </div>
</section>

{{--

@csrf
<input type="hidden" value="{{auth()->guard('student')->user()->id}}" name="student_id">
   <div class="mt-4">
       <label class="text-white dark:text-gray-200" for="username">Title</label>
       <input name="title" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
   </div>
   <div class="mt-4">
       <label class="text-white dark:text-gray-200" for="username">Year</label>
       <input type="number" min="1900" max="2099" step="1" value="2024" name="year" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
   </div>
   <div>
       <label class="text-white dark:text-gray-200" for="members">Members</label>
       <input name="members" id="textarea" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
   </div>
   <div>
       <label class="text-white dark:text-gray-200" for="abstract">Abstract</label>
       <textarea name="abstract" id="textarea" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"></textarea>
   </div>

   <div>
       <label class="block text-sm font-medium text-white mt-2">
       Banner Image
     </label>
       <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
           <div class="space-y-1 text-center">
          
               <div class="flex text-sm text-gray-600">
                       <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                       <span class="">Upload a file</span>
                       <input id="file-upload" name="banner" type="file" class="sr-only">
                   </label>
               </div>
           </div>
       </div>
   </div>
   <div>
       <label class="block text-sm font-medium text-white mt-2">
       File (PDF Format)
       </label>
       <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
           <div class="space-y-1 text-center">
               <div class="flex text-sm text-gray-600">
                   <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                   <span class="">Upload a file</span>
                   <input id="file-upload" name="document" type="file" class="sr-only">
               </label>
           </div>
           </div>
       </div>
   </div>
<div class="flex justify-start mt-6">
   <button class=" px-16 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">Save</button>
</div>

--}}