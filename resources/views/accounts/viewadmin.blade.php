
@include('partials.adminnav')
<div class="content ">
    <div class="pt-8 mb-2">
        
   
<section class="max-w-screen-xl p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-5">
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Admin Information</h1>
    <hr>
    
        <div class="grid grid-cols-4 gap-6 mt-4 sm:grid-cols-3">   
            <div class="col-span-2 ">
                <div class="">
                    <label class="text-white dark:text-gray-200 pl-2" for="lastname">Last Name</label>
                    <input value="{{$admin->lastname}}" readonly name="lastname" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>
                <div class="mt-2">
                    <label class="text-white dark:text-gray-200 pl-2" for="firstname">First Name</label>
                    <input value="{{$admin->firstname}}" readonly name="firstname" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>
                <div class="mt-2">
                    <label class="text-white dark:text-gray-200 pl-2" for="middlename">Middle Name</label>
                    <input value="{{$admin->middlename}}" readonly name="middlename" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div>
                <div class="mt-2">
                    <label class="text-white dark:text-gray-200 pl-2" for="gender">Gender</label>
                    <input value="{{$admin->gender}}" readonly name="gender" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div> 
                <div class="mt-2">
                    <label class="text-white dark:text-gray-200 pl-2 " for="email">Email</label>
                    <input value="{{$admin->email}}" readonly name="email" id="password" type="email" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                </div> 
              
            </div>
            <div class="col-span-1 ">
                <label class="block text-sm font-medium text-white"> Image </label>
                <div class="w-96 relative flex min-h-[150px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] text-center">
                   <img src="{{ asset($admin->photo) }}" class="h-96 w-96 " />
                
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <a href="/admin/dashboard/admin"><button class="mr-4 px-6 py-2 leading-5 text-white transition-colors 
            duration-200 transform bg-whitebg rounded-md hover:bg-gray-700 
            focus:outline-none focus:bg-gray-600">Back</button></a>
        </div>
    
</section>
    
</div>
</div>
@extends('partials.footer')

{{--
    <div class="">
    <a href="/admin/dashboard"><h1>LibArch</h1></a>
    <a href="/admin/dashboard/admin"><h4>Back</h4></a>
    <h1>Admin View</h1>
    
        <label for="lastname">Last Name</label>
        <input name="lastname" type="text" value="{{$admin->lastname}}"><br>
        <label for="firstname">First Name</label>
        <input name="firstname" type="text" value="{{$admin->firstname}}"><br>
        <label for="middlename">Middle Name</label>
        <input name="middlename" type="text" value="{{$admin->middlename}}"><br>
        <label for="gender">Gender</label> 
        <input name="gender" type="text" value="{{$admin->gender}}"><br>
        <label for="email">Email</label> 
        <input name="email" type="email" value="{{$admin->email}}"><br>
        
        <br>
        <label for="photo">Photo</label>
        <img src="{{ asset($admin->photo) }}" width= '100' height='100' class=" rounded-full" />
       
</div>

    --}}