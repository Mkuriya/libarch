@include('partials.adminnav')
<section class="max-w-5xl pt-6 px-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-4">
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Upload Thesis</h1>
    <form action="/student/dashboard/upload/file" method="POST"enctype="multipart/form-data" >
        @csrf
        <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">   
            <div class="col-span-6">
                <label for="" class="text-white dark:text-gray-200">Title</label>
                <input value="{{$file->title}}" readonly type="text" name="title" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div>
            <div class="col-span-6">
                <label for="" class="text-white dark:text-gray-200">Year</label>
                <input value="{{$file->year}}" readonly type="number" min="1900" max="2099" step="1" value="2024" name="year"class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" />
            </div>
        </div>
        <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12"> 
            <div class="col-span-5">
                    <label for="" class="text-white dark:text-gray-200">Members</label>
                    <textarea name="abstract" id="" cols="50" rows="10" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">{{$file->members}}</textarea>
            </div>
            <div class="col-span-5">
                <label for="" class="text-white dark:text-gray-200">Abstract</label>
                <textarea name="abstract" id="" cols="50" rows="10" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">{{$file->abstract}}</textarea>
            </div>
            <div class=" col-span-2">
                <label class="text-white dark:text-gray-200">Book Cover</label>
                <div>
                    <label for="file"class=" px-4 py-2 mt-2 relative flex min-h-[250px] items-center justify-center rounded-md border border-[#e0e0e0] text-center">
                        <div>
                            <img src="{{$file->banner }}" />
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div>
            <label for="" class="text-white dark:text-gray-200">File (PDF ONLY)</label>
            <iframe height="400" width="400" src="{{$file->document}}" frameborder="0" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md"></iframe>
        </div>

    
        <div class="flex justify-end my-2">
            <a href="/admin/dashboard/archive"><button type="button" class=" px-16 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">Back</button></a>
         </div>
    </form>
    
</section>