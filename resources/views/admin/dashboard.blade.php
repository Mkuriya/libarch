@include('partials.adminnav')

  <div class="flex justify-center items-center  h-1/2">
    <div class="px-2">
        <div class="flex mx-8">
          <div class="w-1/3 px-16 ">
            <div class="holder border-white border h-44 w-72  rounded-xl">
                <div class=" mt-5 ml-4 text-lg">Number of Uploded Research</div>
                <div class="text-5xl ml-4 mt-2">4</div>
                <div class="ml-4 mt-6"><a href="/admin/dashboard/archive">View</a></div>
            </div>
          </div>
          <div class="w-1/3 px-16">
            <div class="holder border-white border h-44 w-72  rounded-xl">
                <div class=" mt-5 ml-4 text-lg">Number of Student</div>
                <div class="text-5xl ml-4 mt-2">4</div>
                <div class="ml-4 mt-6"><a href="/admin/dashboard/student">View</a></div>
            </div>
          </div>
          <div class="w-1/3 px-16">
            <div class="holder border-white border h-44 w-72  rounded-xl">
                <div class=" mt-5 ml-4 text-lg">Number of Pending Research</div>
                <div class="text-5xl ml-4 mt-2">4</div>
                <div class="ml-4 mt-6"><a href="/admin/dashboard/archive/pending">View</a></div>
            </div>
          </div>
        </div>
      </div>
  </div>
@extends('partials.footer')
