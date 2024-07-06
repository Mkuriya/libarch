@include('partials.adminnav')

<div class="content">
    <section class="max-w-screen-2xl p-6 mx-auto">
        <div class="grid grid-cols-1 gap-4 pt-4 sm:grid-cols-8">
            <div class="col-span-6">
                <a href="/admin/dashboard/student/register">
                    <button class="ml-4 bg-gray-800 px-5 py-1 text-white dark:hover:text-indigo-500">Register Student</button>
                </a>
            </div>
            <div class="mb-2 text-white col-span-2 border-b-2 border-black">
                <form action="{{ url('/admin/dashboard/student') }}" method="get" class="max-w-md mx-auto">   
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center p-2 ">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        
                        <input type="search" id="default-search" value="{{ request()->input('search') }}" name="search" class="block w-full p-4 ps-10 text-sm text-white  rounded-lg bg-transparent" placeholder="Search Name" required />
                        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-whitebg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <a href="/admin/dashboard/student">
            <button type="button" class="text-white absolute right-1 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                <svg fill="#ffffff" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 489.698 489.698" xml:space="preserve" stroke="#ffffff">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <path d="M468.999,227.774c-11.4,0-20.8,8.3-20.8,19.8c-1,74.9-44.2,142.6-110.3,178.9c-99.6,54.7-216,5.6-260.6-61l62.9,13.1 c10.4,2.1,21.8-4.2,23.9-15.6c2.1-10.4-4.2-21.8-15.6-23.9l-123.7-26c-7.2-1.7-26.1,3.5-23.9,22.9l15.6,124.8 c1,10.4,9.4,17.7,19.8,17.7c15.5,0,21.8-11.4,20.8-22.9l-7.3-60.9c101.1,121.3,229.4,104.4,306.8,69.3 c80.1-42.7,131.1-124.8,132.1-215.4C488.799,237.174,480.399,227.774,468.999,227.774z"></path>
                            <path d="M20.599,261.874c11.4,0,20.8-8.3,20.8-19.8c1-74.9,44.2-142.6,110.3-178.9c99.6-54.7,216-5.6,260.6,61l-62.9-13.1 c-10.4-2.1-21.8,4.2-23.9,15.6c-2.1,10.4,4.2,21.8,15.6,23.9l123.8,26c7.2,1.7,26.1-3.5,23.9-22.9l-15.6-124.8 c-1-10.4-9.4-17.7-19.8-17.7c-15.5,0-21.8,11.4-20.8,22.9l7.2,60.9c-101.1-121.2-229.4-104.4-306.8-69.2 c-80.1,42.6-131.1,124.8-132.2,215.3C0.799,252.574,9.199,261.874,20.599,261.874z"></path>
                        </g>
                    </g>
                </svg>
            </button>
        </a>
        <div class="flex flex-col">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <div class="flex items-center gap-x-3">
                                            <button class="flex items-center gap-x-2">
                                                <span>Name</span>
                                            </button>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Gender
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Department
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Email
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Photo
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                @foreach ($students as $student)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                            {{ $student->lastname }}, {{ $student->firstname }} {{ $student->middlename }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $student->gender }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $student->department }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $student->email }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            <img class="object-cover w-10 h-10 rounded-full" src="{{ asset($student->photo) }}" alt="Student image" />
                                        </td>
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            <div class="flex items-center gap-x-6">
                                                <a href="/admin/dashboard/student/view/{{ $student->id }}" title="View Admin">
                                                    <button class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">View</button>
                                                </a>
                                                <a href="/admin/dashboard/student/edit/{{ $student->id }}" title="Edit Admin">
                                                    <button onclick="return confirm('Update the data?');" class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">Update</button>
                                                </a>
                                                <form action="/admin/dashboard/student/delete/{{ $student->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Permanent Delete?');" class="text-blue-500 transition-colors duration-200 hover:text-indigo-500 focus:outline-none">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                        <nav aria-label="Page navigation example" class="mt-4 grid justify-items-center">
                            <div class="flex">
                                <!-- Previous Button -->
                                @if ($students->onFirstPage())
                                    <span class="flex items-center justify-center mr-3 px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">Previous</span>
                                @else
                                    <a href="{{ $students->previousPageUrl() }}" class="flex mr-3 items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                                @endif
                                <ul class="flex items-center -space-x-px h-8 text-sm">
                                    @if ($students->hasPages())
                                        @foreach ($students->links()->elements as $element)
                                            @if (is_string($element))
                                                <li>
                                                    <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">{{ $element }}</span>
                                                </li>
                                            @endif
                                            @if (is_array($element))
                                                @foreach ($element as $page => $url)
                                                    @if ($page == $students->currentPage())
                                                        <li>
                                                            <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">{{ $page }}</span>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a href="{{ $url }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $page }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                                <!-- Next Button -->
                                @if ($students->hasMorePages())
                                    <a href="{{ $students->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                                @else
                                    <span class="flex items-center justify-center px-3 h-8 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">Next</span>
                                @endif
                            </div>
                        </nav>
                    
                </div>
            </div>
        </div>
    </section>
</div>
@extends('partials.footer')