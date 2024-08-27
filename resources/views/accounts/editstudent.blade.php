@include('partials.adminnav')
<div class="sm:mt-6 mt-0 ">
    <section class="max-w-screen-xl p-6 mx-auto rounded-md shadow-md bg-gray-800 ">
        <h1 class="text-xl font-bold text-white capitalize">Update Student</h1>
        <hr>
        <form action="/admin/dashboard/student/edit/{{$student->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">   
                
                    <div class="col-span-12 sm:col-span-5">
                        <label class="text-gray-200 pl-2" for="lastname">Last Name</label>
                        <input value="{{$student->lastname}}" name="lastname" id="username" type="text" class="block w-full px-4 py-2 mt-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white">
                    </div>
                    <div class="col-span-12 sm:col-span-5">
                        <label class="text-gray-200 pl-2" for="firstname">First Name</label>
                        <input value="{{$student->firstname}}" name="firstname" id="username" type="text" class="block w-full px-4 py-2 mt-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white">
                    </div>
                    <div class="col-span-12 sm:col-span-2">
                        <label class="text-gray-200" for="middlename">Middle Name</label>
                        <input value="{{$student->middlename}}" name="middlename" id="username" type="text" class="block w-full px-4 py-2 mt-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white">
                    </div>
            </div>
            <div class="grid grid-cols-5 gap-6 mt-4 sm:grid-cols-12">
                <div class="col-span-12 sm:col-span-4">
                    <div class="flex items-center">
                        <label class="text-gray-200" for="studentnumber">Student Number</label>
                        <span class="ml-2 text-sm text-gray-400">(Cannot be edited)</span>
                    </div>
                    <input name="studentnumber" value="{{$student->studentnumber}}" disabled id="studentnumber" maxlength="10" type="number" class="hide-arrows block w-full px-4 py-2 mt-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white no-spinner">
                    <span class="text-red-600">@error('studentnumber'){{$message}}@enderror</span>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <div class="flex items-center">
                        <label class="text-gray-200" for="email">Email</label>
                        <span class="ml-2 text-sm text-gray-400">(Cannot be edited)</span>
                    </div>
                    <input name="email" id="email" value="{{$student->email}}" disabled type="email" placeholder="@dhvsu.edu.ph" class="block w-full px-4 py-2 mt-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white">
                    <span class="text-red-600">@error('email'){{$message}}@enderror</span>
                </div>
                
                
                
                <div class="col-span-12 sm:col-span-2">
                    <label class="text-gray-200" for="email">Department</label>
                    <select name="department" class="block w-full px-2 py-2 mt-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white ">
                    <option value="Marketing & Entrepreneurship" {{$student->department == 'Marketing & Entrepreneurship' ? 'selected' : ''}}>Marketing & Entrepreneurship</option>
                        <option value="Engineering" {{$student->department == 'Engineering' ? 'selected' : ''}}>Engineering</option>
                        <option value="Information Technology" {{$student->department == 'Information Technology' ? 'selected' : ''}}>Information Technology</option>
                        <option value="Tourism" {{$student->department == 'Tourism' ? 'selected' : ''}}>Tourism </option>
                        <option value="Education" {{$student->department == 'Education' ? 'selected' : ''}}>Education</option>
                        <option value="Psychology" {{$student->department == 'Psychology' ? 'selected' : ''}}>Psychology</option>
                    </select>
                </div> 
                
                <div class="col-span-12 sm:col-span-2">
                    <label class="text-gray-200" for="gender">Gender</label>
                    <select name="gender" class="block w-full px-4 py-2 mt-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white">
                        <option value="Female" {{$student->gender == 'Female' ? 'selected' : ''}}>Female</option>
                        <option value="Male" {{$student->gender == 'Male' ? 'selected' : ''}}>Male</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-6 mt-4 sm:grid-cols-12">
                <div class="grid-row-2 sm:col-span-10 col-span-12">
                    <div>
                        <label class="text-gray-200" for="password">New Password</label>
                        <input name="password" id="password" type="password" class="block w-full px-4 py-2 mt-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white">
                        @error('password') <span class="text-red-400"> {{$message}}</span>@enderror
                    </div>
                        <br>
                    <div>
                        <label class="text-gray-200" for="passwordConfirmation">Password Confirmation</label>
                        <input name="password_confirmation" id="password_confirmation" type="password" class="block w-full px-4 py-2 mt-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white">
                        
                        @error('password') <span class="text-red-400"> {{$message}}</span>@enderror
                    </div>
                </div>
                <div class="sm:col-span-2 col-span-12">
                    <div class="flex items-center mb-1 space-x-2">
                        <label class="block text-sm font-medium text-white"> Image </label>
                        <p class="text-xs text-gray-400">Image must be 2x2 size.</p>
                    </div>
                    <div>
                        <input type="file" name="photo" id="file" class="sr-only mt-1 flex justify-center px-4 pt-3 pb-4 border-2 border-gray-600 rounded-md" onchange="previewImage(event)" />
                        <label for="file" class="relative flex items-center justify-center rounded-md border bg-gray-700 border-gray-600 text-center">
                            <div id="imagePreviewContainer" class="sm:h-48 sm:w-48 h-80 w-80 "> <!-- Adjust height and width as per requirement -->
                                <img id="imagePreview" src="{{asset('storage/' . $student->photo) }}" class=" object-cover h-full w-full" />
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-6">
                <button type="submit" class="sm:w-20 w-full py-2 leading-5 text-white transition-colors duration-200 transform bg-whitebg rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-600">Update</button>
                <a href="/admin/dashboard/student" class=" ml-4 w-full sm:w-20 px-6 py-2 leading-5 text-white text-center transition-colors duration-200 transform bg-whitebg rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-600"><button type="button" >Back</button></a>
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
