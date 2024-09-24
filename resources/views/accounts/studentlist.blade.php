@include('partials.adminnav')
<div class="max-w-screen-2xl p-6 mx-auto">
    <div class="grid grid-cols-1 gap-4 pt-4 sm:grid-cols-8">
        <div class="col-span-6">
            <a href="/admin/dashboard/student/register">
                <button class="ml-4 bg-gray-800 px-5 py-1 text-white hover:text-indigo-500">Register Student</button>
            </a>
        </div>
        <div class="mb-2 text-white sm:col-span-2 col-span-8 border-b-2 border-black">
            <form action="{{ url('/admin/dashboard/student/filter') }}" id="searchForm" method="get" class="max-w-md mx-auto">   
                <label for="default-search" class="mb-2 text-sm font-medium sr-only text-white">Search</label>
                <div class="flex items-center space-x-2">
                    <a href="/admin/dashboard/student/filter">
                        <button type="button" class=" text-white font-medium rounded-lg text-sm  py-2 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            <svg class="w-6 h-6 hover:text-whitebg text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
                              </svg>                                  
                        </button>
                    </a>
                    <div class="relative flex-1">
                        <input type="search" id="default-search" value="{{ request()->input('search') }}" name="search" class="block bg-transparent w-full py-4 text-sm text-white rounded-lg focus:outline-none  " placeholder="Student Number" />
                        <button type="submit" class="absolute right-1 bottom-2.5 bg-whitebg hover:bg-gray-700 text-white font-medium rounded-lg text-sm px-4 py-2 focus:ring-4 focus:outline-none focus:ring-blue-300">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-700 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-800">
                            <tr>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">Name</th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">Student Number</th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">Gender</th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">Year Level</th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">Department</th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">Email</th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">Photo</th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700 bg-gray-900">
                            @foreach ($students as $student)
                                <tr>
                                    <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">{{ $student->lastname }}, {{ $student->firstname }} {{ $student->middlename }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">{{ $student->studentnumber }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">{{ $student->gender }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">
                                        @if($student->yearlevel == 0)
                                            1st Year
                                        @elseif($student->yearlevel == 1)
                                            2nd Year
                                        @elseif($student->yearlevel == 2)
                                            3rd Year
                                        @elseif($student->yearlevel == 3)
                                            4th Year
                                        @elseif($student->yearlevel == 4)
                                            Graduate
                                        @else
                                            Unknown Year Level
                                        @endif
                                    </td>
                                    
                                    <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">{{ $student->department }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">{{ $student->email }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">
                                        <img class="object-cover w-10 h-10 " src="{{  asset('storage/' . $student->photo)}}" alt="Student image" />
                                    </td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <div class="flex items-center gap-x-6">
                                            <a href="/admin/dashboard/student/view/{{ $student->id }}" title="View Student Details">
                                                <button>
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="12" cy="12" r="1" stroke="#fff" stroke-width="2"/>
                                                        <path d="M18.2265 11.3805C18.3552 11.634 18.4195 11.7607 18.4195 12C18.4195 12.2393 18.3552 12.366 18.2265 12.6195C17.6001 13.8533 15.812 16.5 12 16.5C8.18799 16.5 6.39992 13.8533 5.77348 12.6195C5.64481 12.366 5.58048 12.2393 5.58048 12C5.58048 11.7607 5.64481 11.634 5.77348 11.3805C6.39992 10.1467 8.18799 7.5 12 7.5C15.812 7.5 17.6001 10.1467 18.2265 11.3805Z" stroke="#fff" stroke-width="2"/>
                                                        <path d="M17 4H17.2C18.9913 4 19.887 4 20.4435 4.5565C21 5.11299 21 6.00866 21 7.8V8M17 20H17.2C18.9913 20 19.887 20 20.4435 19.4435C21 18.887 21 17.9913 21 16.2V16M7 4H6.8C5.00866 4 4.11299 4 3.5565 4.5565C3 5.11299 3 6.00866 3 7.8V8M7 20H6.8C5.00866 20 4.11299 20 3.5565 19.4435C3 18.887 3 17.9913 3 16.2V16" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                                                    </svg>
                                                </button>
                                            </a>
                                            <a href="/admin/dashboard/student/edit/{{ $student->id }}" title="Edit Student Details">
                                                <button onclick="return confirm('Update the data?');">
                                                    <svg fill="#fff" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M2,21H8a1,1,0,0,0,0-2H3.071A7.011,7.011,0,0,1,10,13a5.044,5.044,0,1,0-3.377-1.337A9.01,9.01,0,0,0,1,20,1,1,0,0,0,2,21ZM10,5A3,3,0,1,1,7,8,3,3,0,0,1,10,5ZM20.207,9.293a1,1,0,0,0-1.414,0l-6.25,6.25a1.011,1.011,0,0,0-.241.391l-1.25,3.75A1,1,0,0,0,12,21a1.014,1.014,0,0,0,.316-.051l3.75-1.25a1,1,0,0,0,.391-.242l6.25-6.25a1,1,0,0,0,0-1.414Zm-5,8.583-1.629.543.543-1.629L19.5,11.414,20.586,12.5Z"/>
                                                    </svg>
                                                </button>
                                            </a>
                                            <form action="/admin/dashboard/student/delete/{{ $student->id }}" method="post" title="Delete Student Details">
                                                @csrf
                                                @method('DELETE')
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" x="0px" y="0px" width="30" height="30" viewBox="0 0 32 32">
                                                    <path d="M 15 4 C 14.476563 4 13.941406 4.183594 13.5625 4.5625 C 13.183594 4.941406 13 5.476563 13 6 L 13 7 L 7 7 L 7 9 L 8 9 L 8 25 C 8 26.644531 9.355469 28 11 28 L 23 28 C 24.644531 28 26 26.644531 26 25 L 26 9 L 27 9 L 27 7 L 21 7 L 21 6 C 21 5.476563 20.816406 4.941406 20.4375 4.5625 C 20.058594 4.183594 19.523438 4 19 4 Z M 15 6 L 19 6 L 19 7 L 15 7 Z M 10 9 L 24 9 L 24 25 C 24 25.554688 23.554688 26 23 26 L 11 26 C 10.445313 26 10 25.554688 10 25 Z M 12 12 L 12 23 L 14 23 L 14 12 Z M 16 12 L 16 23 L 18 23 L 18 12 Z M 20 12 L 20 23 L 22 23 L 22 12 Z"></path>
                                                    </svg>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation example" class="mt-4 grid justify-items-center">
                    @if ($students->hasPages())
                        <div class="flex">
                            <!-- Previous Button -->
                            @if ($students->onFirstPage())
                                <span class="flex items-center justify-center mr-3 px-3 h-8 text-sm font-medium border rounded-lg bg-gray-800 border-gray-700 text-gray-400">Previous</span>
                            @else
                                <a href="{{ $students->previousPageUrl() }}" class="flex mr-3 items-center justify-center px-3 h-8 text-sm font-medium border rounded-lg hover:bg-gray-100 bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">Previous</a>
                            @endif
                
                            <ul class="flex items-center -space-x-px h-8 text-sm">
                                @foreach ($students->links()->elements as $element)
                                    @if (is_string($element))
                                        <li>
                                            <span class="flex items-center justify-center px-3 h-8 leading-tight border bg-gray-800 border-gray-700 text-gray-400">{{ $element }}</span>
                                        </li>
                                    @endif
                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $students->currentPage())
                                                <li>
                                                    <span class="flex items-center justify-center px-3 h-8 leading-tight border bg-gray-800 border-gray-700 text-gray-400">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ $url }}" class="flex items-center justify-center px-3 h-8 leading-tight border hover:bg-gray-100 bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </ul>
                
                            <!-- Next Button -->
                            @if ($students->hasMorePages())
                                <a href="{{ $students->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 ml-3 text-sm font-medium border rounded-lg bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">Next</a>
                            @else
                                <span class="flex items-center justify-center px-3 h-8 ml-3 text-sm font-medium border rounded-lg bg-gray-800 border-gray-700 text-gray-400">Next</span>
                            @endif
                        </div>
                    @endif
                </nav>                
            </div>
        </div>
    </div>
</div>

<!-- Success/Error Message Container -->
<div class="fixed bottom-4 right-4 z-50 w-96">
    @if(session('success'))
        <div class="bg-gray-200 p-4 rounded relative alert" role="alert">
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
@extends('partials.footer')