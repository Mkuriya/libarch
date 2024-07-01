@include('partials.adminnav')
<div class="content">
    <section class="max-w-screen-2xl  p-6 mx-auto ">
        <div class="grid grid-cols-1 gap-4 pt-4 sm:grid-cols-8"> 
            <div class="col-span-6  ">
                <a href="/admin/dashboard/student/register"><button class="ml-4 bg-gray-800 px-5 py-1 text-white dark:hover:text-indigo-500">Register Student</button></a>
            </div>
            <div class="mb-2 col-span-2 border-b-4 border-black">
                <label for=""> Search: </label>
                <input  type="search" class=" w-10/12  border-black bg-transparent">
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
                                @foreach ($student as $item)
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
                                                <button onclick="return confirm('Update the data?');" class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
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
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@extends('partials.footer')