@include('partials.studentnav')
<div class="content ">
        <div class="grid grid-cols-12 gap-4 pt-4 mb-2"></div>
<section class="max-w-screen-xl p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 ">
    <h1 class="text-xl font-bold text-white capitalize dark:text-white">Change Password</h1>
    <hr>
    <form action="/student/dashboard/profile/changepassword/update" method="POST">
        @csrf
      
        <div class="mt-4">
            <label class="text-white dark:text-gray-200 pl-2" for="lastname">Old Password</label>
            <input name="old_password" id="old_password" type="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
            @error('old_password')
              <span class="text-red-400">
                {{$message}}
              </span>
            @enderror
        </div>
        <div class="mt-4">
            <label class="text-white dark:text-gray-200 pl-2" for="lastname">New Password</label>
            <input  name="new_password" id="new_password" type="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
        </div>
        <div class="mt-4"> 
            <label class="text-white dark:text-gray-200 pl-2" for="lastname">Confirm Password</label>
            <input  name="confirm_password" type="password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
        </div>
        <div class="grid-row-2 col-span-10 mt-12">
            <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">   
                <div class="col-span-6">
                    <button type="submit"  class="block w-full px-4 py-2 mt-2 text-white bg-whitebg 
                        border border-gray-300 rounded-md hover:bg-gray-600">Change Password</button>
                </div>
                <div class="col-span-6">
                    <a href="/student/dashboard/profile/{{auth()->guard('student')->user()->id}} ">
                      <button type="button" class="block w-full px-4 py-2 mt-2 text-white bg-whitebg 
                        border border-gray-300 rounded-md hover:bg-gray-600">Back
                      </button>
                    </a>
                </div>   
            </div> 
        </div> 
    </form>
</section>
<!-- Success Modal -->
<div id="successModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
  <div class="bg-gray-400 p-6 rounded-lg shadow-lg">
      <h3 class="text-xl item-center font-semibold mb-4 border-b-2 border-black">{{ session('status') }}</h3>
      <a href="/student/dashboard/profile/{{auth()->guard('student')->user()->id}}"><button id="closeModal" class="w-full px-4 py-2 bg-whitebg text-white rounded-md hover:bg-gray-700">Close</button></a>
  </div>
</div>

<!-- Hidden Button to Trigger Modal -->
<button id="successButton" class="hidden" type="button" onclick="document.getElementById('successModal').classList.remove('hidden')"></button>

</div>

<script>
  document.addEventListener("DOMContentLoaded", function(event) {
      @if(session('status'))
          document.getElementById('successButton').click();
      @endif
  
      document.getElementById('closeModal').addEventListener('click', function() {
          document.getElementById('successModal').classList.add('hidden');
      });
  });
  </script>
@extends('partials.footer')
