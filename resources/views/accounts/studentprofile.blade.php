@include('partials.studentnav')
<div class="sm:mt-6 mt-0">
    <section class="max-w-screen-xl p-6 mx-auto rounded-md shadow-md bg-gray-800 ">
        <h1 class="text-xl font-bold text-white capitalize ">Update Profile</h1>
        <hr>
        <form action="/student/dashboard/profile/edit/{{$student->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
           
            <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">   
                <div class="col-span-12 sm:col-span-5">
                    <label class="text-white dark:text-gray-200 pl-2" for="lastname">Last Name</label>
                    <input value="{{$student->lastname}}" name="lastname" id="username" type="text" class="block w-full px-4 py-2 mt-2  border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white ">
                </div>
                <div class="col-span-12 sm:col-span-5">
                    <label class="text-white dark:text-gray-200 pl-2" for="firstname">First Name</label>
                    <input value="{{$student->firstname}}" name="firstname" id="username" type="text" class="block w-full px-4 py-2 mt-2  border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white ">
                </div>
                <div class="col-span-12 sm:col-span-2">
                    <label class="text-white dark:text-gray-200" for="middlename">Middle Name</label>
                    <input value="{{$student->middlename}}" name="middlename" id="username" type="text" class="block w-full px-4 py-2 mt-2  border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white ">
                </div>
            </div>
            <div class="grid grid-cols-5 gap-6 mt-4 sm:grid-cols-12">
                <div class="col-span-12 sm:col-span-5">
                    <label class="text-white dark:text-gray-200" for="email">Student Number</label>
                    
                    <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">(Cannot be edited)</span>
                    <input value="{{$student->studentnumber}}" disabled name="studentnumber" id="password" type="email" class="block w-full px-4 py-2 mt-2  border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white ">
                </div> 
                <div class="col-span-12 sm:col-span-5">
                    <label class="text-white dark:text-gray-200" for="email">Email</label>
                    <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">(Cannot be edited)</span>
                    <input value="{{$student->email}}" disabled name="email" id="password" type="email" class="block w-full px-4 py-2 mt-2  border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white ">
                </div> 
                <div class="col-span-12 sm:col-span-2">
                    <label class="text-white dark:text-gray-200" for="gender">Gender</label>
                    <select name="gender" class="block w-full px-4 py-2 mt-2  border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white ">
                        <option value="Female" {{$student->gender == 'Female' ? 'selected' : ''}}>Female</option>
                        <option value="Male" {{$student->gender == 'Male' ? 'selected' : ''}}>Male</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-6 mt-4 sm:grid-cols-12">
                <div class="sm:col-span-2 col-span-10">
                    <label class="block text-sm font-medium text-white">Image</label>
                    <div>
                        <input type="file" name="photo" id="file" class="sr-only mt-1 flex justify-center px-4 pt-3 pb-4 border-2 border-gray-600  rounded-md" onchange="previewImage(event)">
                        <label for="file" class="relative flex sm:min-h-[150px] bg-gray-700 items-center justify-center rounded-md border border-gray-600  text-center">
                            <div id="imagePreviewContainer">
                                <img id="imagePreview" src="{{ asset('storage/' . $student->photo) }}" class="h-48 sm:h-44 w-56 object-cover">
                            </div>
                        </label>
                    </div>
                </div>
                <div class="grid-row-2 col-span-10 mt-0 sm:mt-12">
                    <div>
                        <a href="/student/dashboard/profile/changepassword/{{$student->id}}">
                            <button type="button" class="block w-full px-4 py-2 mt-2 text-white bg-gray-800 border border-gray-300 rounded-md hover:bg-whitebg hover:border-white">Change Password</button>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-6 mt-2 sm:mt-8">
                        <div class="col-span-1">
                            <button type="submit" class="block w-full px-4 py-2 mt-2 text-white bg-whitebg border border-gray-300 rounded-md hover:bg-gray-600">Update</button>
                        </div>
                        <div class="col-span-1">
                            <a href="/student/dashboard">
                                <button type="button" class="block w-full px-4 py-2 mt-2 text-white bg-whitebg border border-gray-300 rounded-md hover:bg-gray-600">Back</button>
                            </a>
                        </div>
                    </div>
                </div>   
                 
            </div>   
        </form>
    
    </section>
</div>
<!-- Success/Error Message Container -->
<div class="fixed bottom-4 right-4 z-50 w-96">
    @if(session('success'))
        <div class="bg-green-200 p-4 rounded relative alert" role="alert">
            {{ session('success') }}
            <button type="button" class="absolute top-0 right-0 mt-2 mr-4 text-lg text-gray-600 hover:text-gray-800" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @elseif(session('error'))
        <div class="bg-sky-500 p-4 rounded relative alert" role="alert">
            {{ session('error') }}
            <button type="button" class="absolute top-0 right-0 mt-2 mr-4 text-lg text-gray-600 hover:text-gray-800" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif
</div>


<script src="/js/previewimage.js"></script>
@extends('partials.footer')
