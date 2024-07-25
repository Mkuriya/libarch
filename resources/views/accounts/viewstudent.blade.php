
@include('partials.adminnav')
<div class="content ">
    <div class="pt-8 mb-2">
        <section class="max-w-screen-xl p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-5">
            <h1 class="text-xl font-bold text-white capitalize dark:text-white">Student Information</h1>
            <hr>
            <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">     
                <div class="col-span-5">
                    <label class="text-white dark:text-gray-200 pl-2" for="lastname">Last Name</label>
                    <input name="lastname" readonly value="{{$student->lastname}}" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white ">
                </div>
                <div class="col-span-5">
                    <label class="text-white dark:text-gray-200 pl-2" for="firstname">First Name</label>
                    <input name="firstname"readonly value="{{$student->firstname}}" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white ">
                </div>
                <div class="col-span-2">
                    <label class="text-white dark:text-gray-200" for="middlename">Middle Name</label>
                    <input name="middlename" readonly value="{{$student->middlename}}" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white ">
                </div>
            </div>
            <div class="grid grid-cols-5 gap-6 mt-4 sm:grid-cols-12">
                <div class="col-span-5">
                    <label class="text-white dark:text-gray-200" for="gender">Gender</label>
                    <input name="email" readonly value="{{$student->gender}}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white ">
                </div>
                <div class="col-span-5">
                    <label class="text-white dark:text-gray-200" for="department">Department</label>
                    <input name="email" readonly value="{{$student->department}}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white ">
                </div>
                <div class="col-span-2">
                    <label class="text-white dark:text-gray-200" for="department">Image</label>
                    <img id='preview_img' class="h-[170px] w-[180px] object-cover absolute"  src="{{asset('storage/' . $student->photo)}}" alt="Current profile photo" />
                </div>
            </div>
            <div class="grid grid-cols-4 gap-6 mt-4 sm:grid-cols-12">
                <div class="grid-row-2 col-span-10">
                    <div class="col-span-4">
                        <label class="text-white dark:text-gray-200" for="studentnumber">Student Number</label>
                        <input name="studentnumber" readonly value="{{$student->studentnumber}}" class="hide-arrows block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white  no-spinner">
                    </div>
                    <div class="col-span-4 mt-2">
                        <label class="text-white dark:text-gray-200" for="email">Email</label>
                        <input name="email" readonly value="{{$student->email}}" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white ">
                    </div> 
                </div>
                <div class=" col-span-2  h-20 mt-20">
                    <div class="flex w-full mt-10">
                        <a href="/admin/dashboard/student" class="w-full">
                            <button type="button" class="w-full px-6 py-2 leading-5 text-white transition-colors 
                        duration-200 transform bg-whitebg rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-600">
                        Back</button>
                        </a>
                    </div>
                </div>
            </div>

            
        </section>  
    </div>
</div>
@extends('partials.footer')
