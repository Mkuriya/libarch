@include('partials.adminnav')
<section class="max-w-5xl pt-6 px-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-4">
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Edit Thesis</h1>
    <form action="/admin/dashboard/archive/pending/edit/{{$file->id}}" method="POST"enctype="multipart/form-data" >
        @csrf   
        @method('PUT') 
        <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">     
          <div class="col-span-5">
            <label for="" class="text-white dark:text-gray-200">Title</label>
            <input readonly value="{{$file->title}}" type="text" name="title" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
          </div>
          <div class="col-span-4">
            <label for="" class="text-white dark:text-gray-200">Year</label>
            <input readonly type="number" min="1900" max="2099" step="1" value="{{$file->year}}" name="year"class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" />
          </div>
          <div class="col-span-3">
            <label for="" class="text-white dark:text-gray-200">Year</label>
            <select name="status" id=""class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" />
              <option value="0" {{$file->status == '0' ? 'selected' : ''}}>Pending</option>
              <option value="1" {{$file->status == '1' ? 'selected' : ''}}>Approve</option>
              <option value="2" {{$file->status == '2' ? 'selected' : ''}}>Decline</option>
            </select>
          </div>
        </div>
        <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">
          <div class="col-span-6">
            <label for="" class="text-white dark:text-gray-200">Student Name</label>
            <input readonly value="{{$file->student->lastname}}, {{$file->student->firstname}}" type="text" name="title" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
          </div>
          <div class="col-span-6">
            <label for="" class="text-white dark:text-gray-200">Course</label>
            <input readonly value="{{$file->student->department}}" type="text" name="title" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
          </div>
          
        </div>
        <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">
          <div class="col-span-9">
            <label for="" class="text-white dark:text-gray-200">Abstract</label>
            <textarea readonly cols="10" rows="8"  class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">{{$file->abstract}}</textarea>
          </div>
         <div class=" w-56 col-span-3 ">
          <label for="" class="text-white dark:text-gray-200">Cover Photo</label>
            <img class="object-contain h-56 w-56 border border-gray-300 " src="{{$file->banner}}">
          </div>
        </div>
        
        <div class="flex justify-end py-4">
          <button class="px-10 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 
          rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600 mr-4" type="submit" onclick="return confirm('Update Data?');">Update</button>
          <a href="/admin/dashboard/archive/pending"><button class="modal-close px-10 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 
          rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600" type="button" >Close</button></a>
        </div>
    </form>
</section>

@include('partials.footer')