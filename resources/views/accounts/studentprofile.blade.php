@include('partials.studentnav')
<div class="content ">
    <div class="grid grid-cols-12 gap-4 pt-4 mb-2"></div>
    <section class="max-w-screen-xl p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 ">
        <h1 class="text-xl font-bold text-white capitalize dark:text-white">Update Profile</h1>
        <hr>
        <form action="/student/dashboard/profile/edit/{{$student->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            <div class="bg-red-400 w-30">
                @if(session('status'))
                  <div class="alert" role="alert">{{session('status')}}</div>    
                @elseif(session('error'))
                  <div class="bg-sky-500" role="alert">{{session('error')}}</div>
                @endif
                    
              </div>
            <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">   
                <div class="col-span-5">
                    <label class="text-white dark:text-gray-200 pl-2" for="lastname">Last Name</label>
                    <input value="{{$student->lastname}}" name="lastname" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white ">
                </div>
                <div class="col-span-5">
                    <label class="text-white dark:text-gray-200 pl-2" for="firstname">First Name</label>
                    <input value="{{$student->firstname}}" name="firstname" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white ">
                </div>
                <div class="col-span-2">
                    <label class="text-white dark:text-gray-200" for="middlename">Middle Name</label>
                    <input value="{{$student->middlename}}" name="middlename" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white ">
                </div>
            </div>
            <div class="grid grid-cols-5 gap-6 mt-4 sm:grid-cols-12">
                <div class="col-span-5">
                    <label class="text-white dark:text-gray-200" for="email">Student Number</label>
                    <input value="{{$student->studentnumber}}" readonly name="studentnumber" id="password" type="email" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white ">
                </div> 
                <div class="col-span-5">
                    <label class="text-white dark:text-gray-200" for="email">Email</label>
                    <input value="{{$student->email}}" readonly name="email" id="password" type="email" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white ">
                </div> 
                <div class="col-span-2">
                    <label class="text-white dark:text-gray-200" for="gender">Gender</label>
                    <select name="gender" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white ">
                        <option value="Female" {{$student->gender == 'Female' ? 'selected' : ''}}>Female</option>
                        <option value="Male" {{$student->gender == 'Male' ? 'selected' : ''}}>Male</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-6 mt-4 sm:grid-cols-12">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-white">Image</label>
                    <div>
                        <input type="file" name="photo" id="file" class="sr-only mt-1 flex justify-center px-4 pt-3 pb-4 border-2 border-gray-300 border-dashed rounded-md" onchange="previewImage(event)" />
                        <label for="file" class="relative flex min-h-[150px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] text-center">
                            <div id="imagePreviewContainer">
                                <img id="imagePreview" src="{{ asset('storage/' . $student->photo) }}"  class=" h-44 w-56 object-cover" />
                            </div>
                        </label>
                    </div>
                </div>
                <div class="grid-row-2 col-span-10 mt-12">
                    <div>
                        <a href="/student/dashboard/profile/changepassword/{{$student->id}}"><button type="button" class="block w-full px-4 py-2 mt-2 text-white bg-gray-800 
                            border border-gray-300 rounded-md hover:bg-whitebg hover:border-white">Change Password</button></a>
                        
                    </div>
                    <div class="grid grid-cols-3 gap-6 mt-8 sm:grid-cols-12">   
                        <div class="col-span-6">
                            <button type="submit"  class="block w-full px-4 py-2 mt-2 text-white bg-whitebg 
                                border border-gray-300 rounded-md hover:bg-gray-600">Update</button>
                        </div>
                        <div class="col-span-6">
                            <a href="/student/dashboard"><button type="button" class="block w-full px-4 py-2 mt-2 text-white bg-whitebg 
                                border border-gray-300 rounded-md hover:bg-gray-600">Back</button></a>
                        </div>   
                    </div> 
                </div>   
            </div>   
        </form>
    
    </section>
</div>

<script src="/js/previewimage.js"></script>
@extends('partials.footer')
