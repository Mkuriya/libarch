@include('partials.studentnav')

<div class="max-w-screen-2xl p-6 mx-auto">
    <div class="grid grid-cols-4 gap-1 sm:px-4 sm:pt-4 sm:grid-cols-8 sm:gap-4">
        <div class="mb-2 text-white col-span-4 sm:col-span-3">
            <form action="{{ url('/student/dashboard/archivelist/filter') }}" id="searchForm" method="get" class="w-full">   
                <label for="default-search" class="mb-2 text-sm font-medium  sr-only text-white">Search</label>
                <div class="relative flex items-center w-full sm:mt-2">
                    <input type="search" id="default-search" value="{{ request()->input('search') }}" name="search" class="block w-full pl-12 pr-2 py-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white  " placeholder="Search Title" />
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-6 h-6  text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>  
        </div>
        <div class="col-span-1 sm:col-span-1">
            <div class="relative">
                <select id="dropdownYear" name="year" class="block w-full px-2 py-2 sm:mt-2  border border-gray-300 rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white ">
                    <option value="" {{ request()->input('year') ? '' : 'selected' }}>Year</option>
                    @for ($year = now()->year; $year >= 2000; $year--)
                        <option value="{{ $year }}" {{ request()->input('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
            </div>
        </div>
        
        <div class="col-span-2 sm:col-span-3">
            <div class="relative">
                <select id="dropdown2" name="student_department" class="block w-full px-2 py-2 sm:mt-2  border border-gray-300 rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white  ">
                    <option value=""   {{ request()->input('student_department') ? '' : 'selected' }}>Department</option>
                    <option value="Marketing & Entrepreneurship" {{ request()->input('student_department') === 'Marketing & Entrepreneurship' ? 'selected' : '' }}>Marketing & Entrepreneurship</option>
                    <option value="Engineering" {{ request()->input('student_department') === 'Engineering' ? 'selected' : '' }}>Engineering</option>
                    <option value="Information Technology" {{ request()->input('student_department') === 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                    <option value="Tourism" {{ request()->input('student_department') === 'Tourism' ? 'selected' : '' }}>Tourism</option>
                    <option value="Education" {{ request()->input('student_department') === 'Education' ? 'selected' : '' }}>Education</option>
                    <option value="Psychology" {{ request()->input('student_department') === 'Psychology' ? 'selected' : '' }}>Psychology</option>
                </select>
            </div>
        </div>
        <div class="col-span-1 sm:col-span-1">
            <button type="submit" class="block w-full px-2 py-2 sm:mt-2  border  rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-white  flex items-center justify-center">
                <svg class="w-6 h-6 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
                </svg> Filter
            </button>
        </div>
    </form>
    </div>
    
    <div class="flex flex-col mt-2">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-700 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-800">
                            <tr>
                                
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                    Title
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                    Year
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                    Abstract
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                    Department
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class=" divide-y divide-gray-700 bg-gray-900">
                            @if($files->isEmpty())
                                <tr>
                                    <td colspan="7" class="px-4 py-4 text-sm font-medium text-gray-200 whitespace-nowrap text-center">
                                        No data found.
                                    </td>
                                </tr>
                            @else
                                @php
                                    $displayed = false;
                                @endphp
                                @foreach ($files as $item)
                                    @if ($item->status == 1)
                                        @php
                                            $displayed = true;
                                        @endphp
                                        <tr>
                                            <td class="px-4 py-4 text-sm text-gray-300 ">
                                                {{$item->title}}
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-300 ">
                                                {{$item->year}}
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-300 ">
                                                <h2 class="text-sm font-normal">{{ \Illuminate\Support\Str::words($item->abstract, 10, '...') }}</h2>
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-300 ">
                                                {{$item->student_department}}
                                            </td>
                                            <td class="px-1 py-4 text-sm "> <!-- for viewer button -->
                                                <a href="/student/dashboard/archivelist/document/{{$item->id}}">
                                                    <button class="hover:border-indigo-500 text-white hover:text-indigo-500 font-bold py-2 px-4 rounded-full">View</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                @if (!$displayed)
                                    <tr>
                                        <td colspan="7" class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap text-center">
                                            No data found.
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        </tbody>
                        
                    </table>
                </div>
                <nav aria-label="Page navigation example" class="mt-4 grid justify-items-center">
                    @if ($files->hasPages())
                        <div class="flex">
                            <!-- Previous Button -->
                            @if ($files->onFirstPage())
                                <span class="flex items-center justify-center mr-3 px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">Previous</span>
                            @else
                                <a href="{{ $files->previousPageUrl() }}" class="flex mr-3 items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                            @endif
                
                            <ul class="flex items-center -space-x-px h-8 text-sm">
                                @foreach ($files->links()->elements as $element)
                                    @if (is_string($element))
                                        <li>
                                            <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">{{ $element }}</span>
                                        </li>
                                    @endif
                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $files->currentPage())
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
                            </ul>
                
                            <!-- Next Button -->
                            @if ($files->hasMorePages())
                                <a href="{{ $files->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                            @else
                                <span class="flex items-center justify-center px-3 h-8 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">Next</span>
                            @endif
                        </div>
                    @endif
                </nav>                    
            </div>
        </div>
    </div>
</div>
@extends('partials.footer')