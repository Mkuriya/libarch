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
                                            <a href="/admin/dashboard/student/view/{{ $student->id }}" title="View Admin">
                                                <button class="transition-colors duration-200 hover:text-whitebg text-gray-300 focus:outline-none">View</button>
                                            </a>
                                            <a href="/admin/dashboard/student/edit/{{ $student->id }}" title="Edit Admin">
                                                <button onclick="return confirm('Update the data?');" class="transition-colors duration-200 hover:text-whitebg text-gray-300 focus:outline-none">Update</button>
                                            </a>
                                            <form action="/admin/dashboard/student/delete/{{ $student->id }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Permanent Delete?');" class="text-red-700 transition-colors duration-200 hover:text-white focus:outline-none">Delete</button>
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