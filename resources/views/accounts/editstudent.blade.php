@include('partials.adminnav')
<div class="content ">
        <div class="grid grid-cols-12 gap-4 pt-4 mb-2">
           
           
        </div>
<section class="max-w-screen-xl p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 ">
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Update Student</h1>
    <hr>
    <form action="/admin/dashboard/student/edit/{{$student->id}}" method="POST" enctype="multipart/form-data">

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
            <div class="col-span-4">
                <label class="text-white dark:text-gray-200" for="studentnumber">Student Number</label>
                <input name="studentnumber" value="{{$student->studentnumber}}" id="studentnumber" maxlength="10" type="number" class="hide-arrows block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring no-spinner">
                <span class="text-red-600">@error('email'){{$message}}@enderror</span>
            </div>
            <div class="col-span-4">
                <label class="text-white dark:text-gray-200" for="email">Email</label>
                <input name="email" id="email" value="{{$student->email}}" readonly type="email" placeholder="@dhvsu.edu.ph" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                <span class="text-red-600"> @error('email'){{$message}}@enderror</span>
            </div> 
            
            
            <div class="col-span-2">
                <label class="text-white dark:text-gray-200" for="email">Department</label>
                <select name="department" class="block w-full px-2 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                   <option value="Marketing & Entrepreneurship" {{$student->department == 'Marketing & Entrepreneurship' ? 'selected' : ''}}>Marketing & Entrepreneurship</option>
                    <option value="Engineering" {{$student->department == 'Engineering' ? 'selected' : ''}}>Engineering</option>
                    <option value="Information Technology" {{$student->department == 'Information Technology' ? 'selected' : ''}}>Information Technology</option>
                    <option value="Tourism" {{$student->department == 'Tourism' ? 'selected' : ''}}>Tourism </option>
                    <option value="Education" {{$student->department == 'Education' ? 'selected' : ''}}>Education</option>
                    <option value="Psychology" {{$student->department == 'Psychology' ? 'selected' : ''}}>Psychology</option>
                </select>
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
                    <label class="text-white dark:text-gray-200" for="password">New Password</label>
                    <input name="password" id="password" type="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    @error('password') <span class="text-red-400"> {{$message}}</span>@enderror
                </div>
                    <br>
                <div>
                    <label class="text-white dark:text-gray-200" for="passwordConfirmation">Password Confirmation</label>
                    <input name="password_confirmation" id="password_confirmation" type="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    
                    @error('password') <span class="text-red-400"> {{$message}}</span>@enderror
                </div>
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-white">Image</label>
                <div>
                    <input type="file" name="photo" id="file" class="sr-only mt-1 flex justify-center px-4 pt-3 pb-4 border-2 border-red-300 border-dashed rounded-md" onchange="previewImage(event)" />
                    <label for="file" class="relative flex min-h-[150px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] text-center">
                        <div id="imagePreviewContainer">
                            <img id="imagePreview" src="{{ asset('storage/' . $student->photo) }}" class="rounded-md object-cover h-48 w-96" />
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit" class=" w-20 py-2 leading-5 text-white transition-colors 
            duration-200 transform bg-whitebg rounded-md hover:bg-gray-700
            focus:outline-none focus:bg-gray-600">Update</button>
            
             <a href="/admin/dashboard/student"><button type="button" class="ml-4 w-20 px-6 py-2 leading-5 text-white transition-colors 
            duration-200 transform bg-whitebg rounded-md hover:bg-gray-700
            focus:outline-none focus:bg-gray-600">Back</button></a>
            
        </div>
    </form>
</section>
</div>
<script>
     document.getElementById('studentnumber').addEventListener('input', function (event) {
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });
    document.getElementById('studentnumber').addEventListener('input', function() {
        var studentNumber = this.value;
        var email = studentNumber + '@dhvsu.edu.ph';
        document.getElementById('email').value = email;
    });
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();
        
        reader.onload = function() {
            const dataURL = reader.result;
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = dataURL;
        };
        
        reader.readAsDataURL(input.files[0]);
    }
</script>
@extends('partials.footer')
