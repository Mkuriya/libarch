@include('partials.adminnav')
<div class="content">
    <section class="max-w-screen-2xl p-6 mx-auto">
        <div class="grid grid-cols-1 gap-4 pt-4 sm:grid-cols-8">
            <div class="col-span-6">
                <a href="/admin/dashboard/admin/register">
                    <button class="ml-4 bg-gray-800 px-5 py-1 text-white dark:hover:text-indigo-500">Register Admin</button>
                </a>
            </div>
            <div class="mb-2 text-white col-span-2 border-b-2 border-black">
                <form action="{{ url('/admin/dashboard/admin') }}" id="searchForm" method="get" class="max-w-md mx-auto">   
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center p-2 ">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        
                        <input type="search" id="default-search" value="{{ request()->input('search') }}" name="search" class="block w-full p-4 ps-10 text-sm text-white  rounded-lg bg-transparent" placeholder="Search Name" />
                        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-whitebg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="flex flex-col">
           <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 ">
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
                                @foreach ($admins as $item)
                                    @if ($item->id != 1)
                                        <tr>
                                            <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                                <div class="inline-flex items-center gap-x-3">
                                                
                                                    <span>{{$item->lastname}}, {{$item->firstname}} {{$item->middlename}}</span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{$item->gender}}</td>
                                            <td class="px-4 py-4 text-sm ext-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                    <h2 class="text-sm font-normal">{{$item->email}}</h2>
                                                
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                <div class="flex items-center gap-x-2">
                                                    <img class="object-cover w-10 h-10 " src="{{ asset($item->photo) }}" alt="">
                                                </div>
                                            </td>
                                            <td class="px-1 py-4 text-sm whitespace-nowrap">
                                                <div class="flex items-center gap-x-6">
                                                    <a href="/admin/dashboard/admin/view/{{$item->id}}"title="View Admin">
                                                        <button class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                                            View
                                                        </button>
                                                    </a>
                                                    <a href="/admin/dashboard/admin/edit/{{$item->id}}"   title="Edit Admin">
                                                        <button class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                                            Update
                                                        </button>
                                                    </a>
                                                    <form action="/admin/dashboard/admin/delete/{{$item->id}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Permanent Delete?');" class="text-blue-500 transition-colors duration-200 hover:text-indigo-500 focus:outline-none">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="Page navigation example" class="mt-4 grid justify-items-center">
                        <div class="flex">
                            <!-- Previous Button -->
                            @if ($admins->onFirstPage())
                                <span class="flex items-center justify-center mr-3 px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">Previous</span>
                            @else
                                <a href="{{ $admins->previousPageUrl() }}" class="flex mr-3 items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                            @endif
                            <ul class="flex items-center -space-x-px h-8 text-sm">
                                @if ($admins->hasPages())
                                    @foreach ($admins->links()->elements as $element)
                                        @if (is_string($element))
                                            <li>
                                                <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">{{ $element }}</span>
                                            </li>
                                        @endif
                                        @if (is_array($element))
                                            @foreach ($element as $page => $url)
                                                @if ($page == $admins->currentPage())
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
                            @if ($admins->hasMorePages())
                                <a href="{{ $admins->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
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