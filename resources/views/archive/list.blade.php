@include('partials.adminnav')
<div class="content px-10">
    <div class="text-xl font-bold text-white capitalize dark:text-white px-2 py-4 grid grid-cols-12 gap-6 mb-4 sm:grid-cols-12">
        <p class="absolute left-12"><a href="/admin/dashboard/archive">Archive List</a></p>
        <a href="/admin/dashboard/archive/pending"><button class="absolute right-12 bg-whitebg hover:bg-gray-600 rounded-full px-8"> List</button></a>
        
    {{--}}    <div class="max-w-3xl absolute left-[30%] top-[5%] bg-red-800">
        <form class="max-w-md mx-auto">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form></div>--}}
   </div>
    <hr>
    <div class="grid grid-cols-1 sm:grid-cols-7 md:grid-cols-7 gap-x-6 gap-y-10">
    @foreach ($file as $item)
        @if($item->status == 1)
            <a href=""
                class="mt-2 flex flex-col bg-white drop-shadow hover:drop-shadow-lg hover:opacity-70 rounded-md">
                <img src="{{$item['banner']}}" alt="Fiction Product"
                    class="h-30 object-contain rounded-tl-md rounded-tr-md">

                <div class="px-2 py-2">
                    <h1 class="font-semibold">{{$item['title']}}</h1>
                    <p class="text-sm">{{$item['year']}}</p>
                    <p class="text-sm">{{$item->student->firstname}}</p>
                </div>
            </a>
        @else
            
        @endif
    @endforeach
    </div>
</div>
@extends('partials.footer')



