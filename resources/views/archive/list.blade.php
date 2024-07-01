@include('partials.adminnav')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="my-2 flex sm:flex-row flex-col">
            <div class="flex flex-row mb-1 sm:mb-0">
                <div class="relative">
                    <select class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b 
                    block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight 
                    focus:outline-none  focus:border-gray-500">
                        <option> <a href="/admin/dashboard/archive/pending">All</a></option>
                        <option><a href="/admin/dashboard/archive/pending">Approve</a></option>
                        <option><a href="/admin/dashboard/archive/pending">Decline</a></option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="block relative">
                <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                        <path
                            d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                        </path>
                    </svg>
                </span>
                <input placeholder="Search"
                    class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
            </div>
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Title
                            </th>
                            <th class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Rol
                            </th>
                            <th class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Created at
                            </th>
                            <th class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                        @foreach ($file as $item)
                                <tr>
                                    <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                        <div class="inline-flex items-center gap-x-3">
                                        
                                            <span>{{$item->lastname}}, {{$item->firstname}} {{$item->middlename}}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">{{$item->gender}}</td>
                                    <td class="px-4 py-4 text-sm ext-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            <h2 class="text-sm font-normal">{{$item->department}}</h2>
                                    </td>
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
                                            <a href="/admin/dashboard/student/view/{{$item->id}}"title="View Admin">
                                                <button class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                                    View
                                                </button>
                                            </a>
                                            <a href="/admin/dashboard/student/edit/{{$item->id}}"   title="Edit Admin">
                                                <button onclick="return confirm('Update teh data?');" class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                                    Update
                                                </button>
                                            </a>
                                            <form action="/admin/dashboard/student/delete/{{$item->id}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Permanent Delete?');" class="text-blue-500 transition-colors duration-200 hover:text-indigo-500 focus:outline-none">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                    </tbody>
                </table>
                <div
                    class="px-5 py-5 bg-gray-900 border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                    <span class="text-xs xs:text-sm text-white">
                        Showing 1 to 4 of 50 Entries
                    </span>
                    <div class="inline-flex mt-2 xs:mt-0">
                        <button
                            class="text-sm bg-whitebg hover:bg-gray-400 text-white font-semibold py-2 px-4 rounded-l">
                            Prev
                        </button>
                        <button
                            class="text-sm bg-whitebg hover:bg-gray-400 text-white font-semibold py-2 px-4 rounded-r">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@extends('partials.footer')

