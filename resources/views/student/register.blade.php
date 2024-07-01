@include('partials.adminnav')
<div class="content ">
    <div class="grid grid-cols-12 gap-4 pt-4 mb-2"></div>
    <section class="max-w-screen-xl p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 ">
        <h1 class="text-xl font-bold text-white capitalize dark:text-white">Register Student</h1>
        <hr>
        <form action="/admin/dashboard/studentregister" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">   
                
                    <div class="col-span-5">
                        <label class="text-white dark:text-gray-200 pl-2" for="lastname">Last Name</label>
                        <input name="lastname" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                        <span class="text-red-600"> @error('lastname'){{$message}}@enderror</span>
                    </div>
                    <div class="col-span-5">
                        <label class="text-white dark:text-gray-200 pl-2" for="firstname">First Name</label>
                        <input name="firstname" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                        <span class="text-red-600"> @error('firstname'){{$message}}@enderror</span>
                    </div>
                    <div class="col-span-2">
                        <label class="text-white dark:text-gray-200" for="middlename">Middle Name</label>
                        <input name="middlename" id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                        <span class="text-red-600"> @error('middlename'){{$message}}@enderror</span>
                    </div>
            </div>
            <div class="grid grid-cols-5 gap-6 mt-4 sm:grid-cols-12">
                <div class="col-span-8">
                    <label class="text-white dark:text-gray-200" for="email">Email</label>
                    <input name="email" id="password" type="email" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    <span class="text-red-600"> @error('email'){{$message}}@enderror</span>
                </div> 
                
                <div class="col-span-2">
                    <label class="text-white dark:text-gray-200" for="gender">Gender</label>
                    <select name="gender" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="text-white dark:text-gray-200" for="department">Department</label>
                    <select name="department" class="block w-full px-2 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                        <option value="Marketing & Entrepreneurship">Marketing & Entrepreneurship</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Information Technology">Information Technology</option>
                        <option value="Tourism">Tourism </option>
                        <option value="Education">Education</option>
                        <option value="Psychology">Psychology</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-6 mt-4 sm:grid-cols-12">
                <div class="grid-row-2 col-span-10">
                    <div>
                        <label class="text-white dark:text-gray-200" for="password">Password</label>
                        <input name="password"  id="password" type="password" class=" block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                        <span class="text-red-600"> @error('password'){{$message}}@enderror</span>
                    </div>
                        <br>
                    <div>
                        <label class="text-white dark:text-gray-200" for="passwordConfirmation">Password Confirmation</label>
                        <input name="password_confirmation" id="passwordConfirmation" type="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                        <span class="text-red-600"> @error('password'){{$message}}@enderror</span>
                    </div>
                </div>
                <div class=" col-span-2">
                    <label class="block text-sm font-medium text-white"> Image </label>
                    <div>
                        <label class="block  hover:bg-gray-700">
                            <input type="file" name="photo" onchange="loadFile(event)" class="
                             mt-2 w-42 flex justify-center px-2 py-2 border border-dashed border-[#e0e0e0] rounded-md block w-full text-sm text-white
                              file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-sm file:font-semibold
                              file:bg-transparent file:text-white hover:file:bg-gray-700"/>
                          </label><span class="text-red-600"> @error('photo'){{$message}}@enderror</span>
                        <label for="file"class="mt-2 relative flex min-h-[150px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] text-center">
                            <img id='preview_img' class="h-[170px] w-[180px] object-cover"  src="/img/Profile.jpg" alt="Current profile photo" />
                        </label>
                        
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class=" w-20  px-6 py-2 leading-5 text-white transition-colors 
                duration-200 transform bg-whitebg rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-600">Save</button>
                <a href="/admin/dashboard/student">
                    <button type="button" class="ml-4 w-20 px-6 py-2 leading-5 text-white transition-colors 
                duration-200 transform bg-whitebg rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-600">
                Back</button>
                </a>
               
            </div>
        </form>
    </section>
</div>
@extends('partials.footer')
  
<script>
  var loadFile = function(event) {
    var input = event.target;
    var file = input.files[0];
    var type = file.type;
    var output = document.getElementById('preview_img');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
          URL.revokeObjectURL(output.src) // free memory
      }
  };
  </script>