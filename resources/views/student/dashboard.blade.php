@include('partials.studentnav')
<div class="bg-red-300">
    <p class="absolute w-[951px] h-[132px] not-italic font-semibold text-4xl leading-[44px] text-center text-white  left-64 top-[200px]">
      Welcome! How can I assist you today? Whether you have a question, need some information, or just want to chat, I'm here to help.
    </p>
   
</div>

<div class="flex justify-center items-center mt-20 h-5/6"> 
  <div class="absolute top-[360px] h-1 w-3/4 bg-white"></div>
  <div class="px-2">
    <div class="flex mx-8">
      <div class="w-1/2 px-16 ">
        <a href="/student/dashboard/upload"class=" w-[200px] h-[65px]  flex justify-center item-center">
          <button type="button" class=" w-full h-full text-white bg-whitebg hover:bg-gray-700  font-medium rounded-lg text-xl px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 me-2 mb-2">
            Upload 
            <svg class="w-7 h-7 ml-12 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v9m-5 0H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2M8 9l4-5 4 5m1 8h.01"/>
            </svg>
          </button>
        </a>
      </div>
      <div class="w-1/2 px-16">
        <a href="/student/dashboard/search"class=" w-[200px] h-[65px]  flex justify-center item-center">
          <button type="button" class=" w-full h-full text-white bg-whitebg hover:bg-gray-700  font-medium rounded-lg text-xl px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 me-2 mb-2">
            Search 
            <svg class="w-6 h-6 ml-12 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
            </svg>
          </button>
        </a>
        
      </div>    
    </div>
  </div>
</div>
@extends('partials.footer')
    {{--}}
for student dashboard
<section class="text-gray-700 body-font">
    <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
      <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
        <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Welcome! How can I assist you today?<br> Whether you have a question, need some information,
            <br> or just want to chat, I'm here to help.
          
        </h1>
        <div class=" h-1 w-3/4 bg-white"></div>
        <div class="flex justify-center">
            <a href=""class=" w-[200px] h-[55px]  flex justify-center item-center">
                <button type="button" class=" inline-flex w-full h-full text-white bg-whitebg hover:bg-gray-700  font-medium rounded-lg text-xl px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 me-2 mb-2">
                  Upload 
                  <svg class="w-7 h-7 ml-10 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v9m-5 0H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2M8 9l4-5 4 5m1 8h.01"/>
                  </svg>
                </button>
              </a>
          <button class="ml-4 inline-flex text-gray-700 bg-gray-200 border-0 py-2 px-6 focus:outline-none hover:bg-gray-300 rounded text-lg">Button</button>
        </div>
      </div>
      
    </div>
  </section>
--}}