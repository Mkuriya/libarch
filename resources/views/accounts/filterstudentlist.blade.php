@include('partials.adminnav')

<div class="content">
    <section class="max-w-screen-2xl p-6 mx-auto">
        <div class="grid grid-cols-1 gap-4 px-4 pt-4 sm:grid-cols-8">
            <div class="mb-2 text-white col-span-3 ">
                <form action="{{ url('/admin/dashboard/student/filter') }}" id="searchForm" method="get" class="w-full">   
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative flex items-center w-full mt-2">
                        <input type="search" id="default-search" value="{{ request()->input('search') }}" name="search" class="block w-full pl-12 pr-2 py-2 text-gray-800 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white " placeholder="Search Student Name/Number" />
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-6 h-6 text-gray-800 dark:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    
            </div>
            <div class="col-span-2">
                <div class="relative">
                    <select id="dropdown1" name="gender" class="block w-full px-2 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white ">
                        <option value=""  {{ request()->input('gender') ? '' : 'selected' }}>Gender</option>
                        <option value="Male" {{ request()->input('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ request()->input('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
            </div>
            <div class="col-span-2">
                <div class="relative">
                    <select id="dropdown2" name="department" class="block w-full px-2 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white ">
                        <option value=""  {{ request()->input('department') ? '' : 'selected' }}>Department</option>
                        <option value="Marketing & Entrepreneurship" {{ request()->input('department') === 'Marketing & Entrepreneurship' ? 'selected' : '' }}>Marketing & Entrepreneurship</option>
                        <option value="Engineering" {{ request()->input('department') === 'Engineering' ? 'selected' : '' }}>Engineering</option>
                        <option value="Information Technology" {{ request()->input('department') === 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                        <option value="Tourism" {{ request()->input('department') === 'Tourism' ? 'selected' : '' }}>Tourism</option>
                        <option value="Education" {{ request()->input('department') === 'Education' ? 'selected' : '' }}>Education</option>
                        <option value="Psychology" {{ request()->input('department') === 'Psychology' ? 'selected' : '' }}>Psychology</option>
                    </select>
                </div>
            </div>
            <div class="col-span-1">
                <button type="submit" class="block w-full px-2 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-white dark:focus:border-white  flex items-center justify-center  w-full">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
                    </svg>
                </button>
            </div>
        </form>
        </div>
        <div class="flex flex-col mt-2">
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
                                        Student Number
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
                                @if($students->isEmpty())
                                    <tr>
                                        <td colspan="7" class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap text-center">
                                            No data found.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($students as $student)
                                        <tr>
                                            <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                                {{ $student->lastname }}, {{ $student->firstname }} {{ $student->middlename }}
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $student->studentnumber }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $student->gender }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $student->department }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{ $student->email }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                <img class="object-cover w-10 h-10 " src="{{  asset('storage/' . $student->photo)}}" alt="Student image" />
                                            </td>
                                            <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                <div class="flex items-center gap-x-6">
                                                    <a href="/admin/dashboard/student/view/{{ $student->id }}" title="View Admin">
                                                        <button class="text-gray-500 transition-colors duration-200 dark:hover:text-whitebg dark:text-gray-300 hover:text-whitebg focus:outline-none">View</button>
                                                    </a>
                                                    <a href="/admin/dashboard/student/edit/{{ $student->id }}" title="Edit Admin">
                                                        <button onclick="return confirm('Update the data?');" class="text-gray-500 transition-colors duration-200 dark:hover:text-whitebg dark:text-gray-300 hover:text-whitebg focus:outline-none">Update</button>
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
                                @endif
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