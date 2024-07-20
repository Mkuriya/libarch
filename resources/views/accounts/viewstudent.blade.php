
@include('partials.adminnav')
<div class="content ">
    <div class="pt-8 mb-2">
        
   
<section class="max-w-screen-xl p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-5">
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Student Information</h1>
    <hr>
    
        <div class="grid grid-cols-4 gap-6 mt-4 sm:grid-cols-3">   
            <div class="col-span-2 ">
                <div class="">
                    <label class="text-white dark:text-gray-200 pl-2" for="lastname">Last Name</label>
                    <input value="{{$student->lastname}}" readonly name="lastname" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>
                <div class="mt-2">
                    <label class="text-white dark:text-gray-200 pl-2" for="firstname">First Name</label>
                    <input value="{{$student->firstname}}" readonly name="firstname" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>
                <div class="mt-2">
                    <label class="text-white dark:text-gray-200 pl-2" for="middlename">Middle Name</label>
                    <input value="{{$student->middlename}}" readonly name="middlename" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>
                <div class="mt-2">
                    <label class="text-white dark:text-gray-200 pl-2" for="gender">Gender</label>
                    <input value="{{$student->gender}}" readonly name="gender" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div> 
                <div class="mt-2">
                    <label class="text-white dark:text-gray-200 pl-2" for="gender">Department</label>
                    <input value="{{$student->department}}" readonly name="gender" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div> 
                <div class="mt-2">
                    <label class="text-white dark:text-gray-200 pl-2 " for="email">Email</label>
                    <input value="{{$student->email}}" readonly name="email" id="password" type="email" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div> 
              
            </div>
            <div class="col-span-1 ">
                <label class="block text-sm font-medium text-white"> Image </label>
                <div class="w-96 relative flex min-h-[150px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] text-center">
                   <img src="{{  asset('storage/' . $student->photo) }}" class="object-cover h-96 w-96 " />
                
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <a href="/admin/dashboard/student"><button class="mr-4 px-6 py-2 leading-5 text-white transition-colors 
            duration-200 transform bg-whitebg rounded-md hover:bg-gray-700 
            focus:outline-none focus:bg-gray-600">Back</button></a>
        </div>
    
</section>
    
</div>
</div>
@extends('partials.footer')
