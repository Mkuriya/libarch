@include('partials.studentnav')
<div class="content ">
        <div class="grid grid-cols-12 gap-4 pt-4 mb-2">
           
           
        </div>
<section class="max-w-screen-xl p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 ">
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Update Profile</h1>
    <hr>
    <form action="/student/dashboard/profile/edit/{{$student->id}}" method="POST">

        @csrf
        @method('PUT') 
        <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">   
            
                <div class="col-span-5">
                    <label class="text-white dark:text-gray-200 pl-2" for="lastname">Last Name</label>
                    <input value="{{$student->lastname}}" name="lastname" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>
                <div class="col-span-5">
                    <label class="text-white dark:text-gray-200 pl-2" for="firstname">First Name</label>
                    <input value="{{$student->firstname}}" name="firstname" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>
                <div class="col-span-2">
                    <label class="text-white dark:text-gray-200" for="middlename">Middle Name</label>
                    <input value="{{$student->middlename}}" name="middlename" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>
        </div>
        <div class="grid grid-cols-5 gap-6 mt-4 sm:grid-cols-12">
            <div class="col-span-10">
                <label class="text-white dark:text-gray-200" for="email">Email</label>
                <input value="{{$student->email}}" name="email" id="password" type="email" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            </div> 
            
            <div class="col-span-2">
                <label class="text-white dark:text-gray-200" for="gender">Gender</label>
                <select name="gender" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    <option value="Female" {{$student->gender == 'Female' ? 'selected' : ''}}>Female</option>
                    <option value="Male" {{$student->gender == 'Male' ? 'selected' : ''}}>Male</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-4 gap-6 mt-4 sm:grid-cols-12">
            <div class="grid-row-2 col-span-10">
                <div>
                    <label class="text-white dark:text-gray-200" for="password">Password</label>
                    <input disabled name="password" id="password" type="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @error('password'){{$message}}@enderror
                </div>
                    <br>
                <div>
                    <label class="text-white dark:text-gray-200" for="passwordConfirmation">Password Confirmation</label>
                    <input disabled name="password_confirmation" id="passwordConfirmation" type="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @error('password'){{$message}}@enderror
                </div>
            </div>
            <div class=" col-span-2">
                <label class="block text-sm font-medium text-white"> Image </label>
              <div>
                <input type="file" name="photo" id="file" class="sr-only mt-1 flex justify-center px-4 pt-3 pb-4 border-2 border-gray-300 border-dashed rounded-md" />
                <label for="file"class="relative flex min-h-[150px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] text-center">
                    <div>
                        <img src="{{ asset($student->photo) }}" />
                
                      
                    </div>
                </label>{{----}}
              </div>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button class="relative right-24 w-24 px-6 py-2 leading-5 text-white transition-colors 
            duration-200 transform bg-whitebg rounded-md hover:bg-gray-700
            focus:outline-none focus:bg-gray-600">Update</button>
            
        </div>
    </form>
    <div class="pl-10 flex justify-end ">
        <a href="/student/dashboard"><button class="relative bottom-9  w-20 px-6 py-2 leading-5 text-white transition-colors 
            duration-200 transform bg-whitebg rounded-md hover:bg-gray-700
            focus:outline-none focus:bg-gray-600">Back</button></a>
    </div>
</section>
</div>

@extends('partials.footer')
