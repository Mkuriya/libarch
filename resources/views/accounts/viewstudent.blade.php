@include('partials.adminnav')
<div class="sm:mt-6 mt-0">
    <section class="max-w-screen-xl p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 sm:mt-5">
        <h1 class="text-xl font-bold text-white capitalize dark:text-white">Student Information</h1>
        <hr>
        <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">   
            <div class="sm:col-span-5 col-span-12">
                <label class="text-white dark:text-gray-200 pl-2" for="lastname">Last Name</label>
                <input value="{{$student->lastname}}" disabled name="lastname" id="lastname" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white ">
            </div>
            <div class="sm:col-span-5 col-span-12">
                <label class="text-white dark:text-gray-200 pl-2" for="firstname">First Name</label>
                <input value="{{$student->firstname}}"disabled name="firstname" id="firstname" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white ">
            </div>
            <div class="sm:col-span-2 col-span-12">
                <label class="text-white dark:text-gray-200" for="middlename">Middle Name</label>
                <input value="{{$student->middlename}}" disabled name="middlename" id="middlename" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white ">
            </div>
        </div>
        <div class="grid grid-cols-4 gap-6 sm:mt-6 sm:grid-cols-12">
            <div class="grid-row-2 col-span-10">
                <div class="grid grid-cols-3 gap-6  sm:grid-cols-10">   
                    <div class="col-span-5">
                        <label class="text-white dark:text-gray-200 pl-2" for="department">Department</label>
                        <input value="{{$student->department}}" disabled name="department" id="department" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white ">
                    </div>
                    <div class="col-span-5">
                        <label class="text-white dark:text-gray-200 pl-2" for="gender">Gender</label>
                        <input value="{{$student->gender}}" disabled name="gender" id="gender" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white ">
                    </div>
                </div>
                <br>
                <div class="grid grid-cols-3 gap-4  sm:grid-cols-10">   
                    <div class="col-span-5">
                        <div class="flex items-center">
                            <label class="text-white dark:text-gray-200" for="email">Email</label>
                        </div>
                        <input name="email" id="email" value="{{$student->email}}" disabled type="email" placeholder="@dhvsu.edu.ph" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white">
                        <span class="text-red-600">@error('email'){{$message}}@enderror</span>
                    </div>
                    <div class="col-span-5">
                        <div class="flex items-center">
                            <label class="text-white dark:text-gray-200" for="studentnumber">Student Number</label>
                        </div>
                        <input name="studentnumber" value="{{$student->studentnumber}}" disabled id="studentnumber" maxlength="10" type="number" class="hide-arrows block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white no-spinner">
                        <span class="text-red-600">@error('studentnumber'){{$message}}@enderror</span>
                    </div>
                </div>
            </div>
            <div class="sm:col-span-2  col-span-10">
                <label class="block text-sm font-medium  text-white">Image</label>
                    <div class="relative flex items-center justify-center w-full h-96 sm:w-44 sm:h-48 rounded-md border border-gray-600 text-center">
                        <img class="object-cover  w-full h-full " src="{{ asset('storage/' . $student->photo) }}"/>
                    </div>
            </div>
        </div>
        <div class="flex justify-end  mt-6">
            <a href="/admin/dashboard/student" class="block w-full sm:w-auto">
                <button type="button" class="w-full sm:w-48 px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-whitebg rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-600">Back</button>
            </a>
        </div>
    </section>
</div>


@extends('partials.footer')
