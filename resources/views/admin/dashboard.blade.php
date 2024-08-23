@include('partials.adminnav')
<!-- component -->
<div class="p-10">
  <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 place-items-center">
    <div class="relative overflow-hidden rounded-lg bg-gray-600 px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6 text-center flex flex-col items-center justify-center">
      <p class="text-2xl font-medium text-white">Total Uploaded</p>
      <p class="text-2xl font-semibold text-gray-100">{{$totalUpload}}</p><br>
      <a href="/admin/dashboard/archive" class="block">
        <div class="absolute inset-x-0 bottom-0 bg-whitebg hover:bg-gray-700 px-4 py-4 sm:px-6">
          <div class="text-sm text-center">
            <p class="font-medium text-white">View all</p>
          </div>
        </div>
      </a>
    </div>

    <div class="relative overflow-hidden rounded-lg bg-gray-600 px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6 text-center flex flex-col items-center justify-center">
      <p class="text-2xl font-medium text-white">Total Pending</p>
      <p class="text-2xl font-semibold text-gray-100">{{$totalPending}}</p>
      <br>
      <a href="/admin/dashboard/archive/pending" class="block ">  
        <div class="absolute inset-x-0 bottom-0 bg-whitebg hover:bg-gray-700 px-4 py-4 sm:px-6">
          <div class="text-sm text-center">
            <p class="font-medium text-white">View all</p>
          </div>
        </div>
      </a>
    </div>

    <div class="relative overflow-hidden rounded-lg bg-gray-600 px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6 text-center flex flex-col items-center justify-center">
      <p class="text-2xl font-medium text-white">Total Student</p>
      <p class="text-2xl font-semibold text-gray-100">{{$totalStudent}}</p><br>
      <a href="/admin/dashboard/student" class="block">  
        <div class="absolute inset-x-0 bottom-0 bg-whitebg hover:bg-gray-700 px-4 py-4 sm:px-6">
            <div class="text-sm text-center">
              <p class="font-medium text-white">View all</p>
            </div>
        </div>
      </a>
        
    </div>
  </dl>
</div>

{{--
  <div class="flex justify-center items-center  h-1/2">
    <div class="px-2">
        <div class="flex mx-8">
          <div class="w-1/3 px-16 ">
            <div class="holder border-white border h-44 w-72  rounded-xl">
                <div class=" mt-5 ml-4 text-lg">Number of Uploded Research</div>
                <div class="text-5xl ml-4 mt-2">{{$totalUpload}}</div>
                <div class="ml-4 mt-6"><a href="/admin/dashboard/archive">View</a></div>
            </div>
          </div>
          <div class="w-1/3 px-16">
            <div class="holder border-white border h-44 w-72  rounded-xl">
                <div class=" mt-5 ml-4 text-lg">Number of Student</div>
                <div class="text-5xl ml-4 mt-2">{{$totalStudent}}</div>
                <div class="ml-4 mt-6"><a href="/admin/dashboard/student">View</a></div>
            </div>
          </div>
          <div class="w-1/3 px-16">
            <div class="holder border-white border h-44 w-72  rounded-xl">
                <div class=" mt-5 ml-4 text-lg">Number of Pending Research</div>
                <div class="text-5xl ml-4 mt-2">{{$totalPending}}</div>
                <div class="ml-4 mt-6"><a href="/admin/dashboard/archive/pending">View</a></div>
            </div>
          </div>
        </div>
      </div>
  </div>--}}
@extends('partials.footer')
