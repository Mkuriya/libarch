@include('partials.adminnav')
<div class="">
    <section class="max-w-screen-2xl p-6 mx-auto">
        <div class="grid grid-cols-1 gap-4 pt-4 sm:grid-cols-8">
            <div class="sm:col-span-6 col-span-8">
                <a href="/admin/dashboard/admin/register">
                    <button class="ml-4 bg-gray-800 px-5 py-1 text-white dark:hover:text-indigo-500">Register Admin</button>
                </a>
            </div>
            <div class="mb-2 mr-4 text-white sm:col-span-2 col-span-8 border-b-2 border-black">
                <form action="{{ url('/admin/dashboard/admin') }}" id="searchForm" method="get" class="max-w-md mx-auto">   
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center p-2">
                            <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        
                        <input type="search" id="default-search" value="{{ request()->input('search') }}" name="search" class="block bg-transparent w-full pl-10 py-4 text-sm text-white rounded-lg focus:outline-none" placeholder="Search Name" />
                        <button type="submit" class="text-white absolute end-0 bottom-2.5 bg-whitebg hover:bg-gray-800 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="flex flex-col">
           <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 ">
                 <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden border border-gray-700 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-400">
                                        <div class="flex items-center gap-x-3">
                                            <button class="flex items-center gap-x-2">
                                                <span>Name</span>
                                            </button>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                        Gender
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                        Email
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                        Photo
                                    </th>
                                    <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class=" divide-y divide-gray-700 bg-gray-900">
                                @if($admins->isEmpty())
                                    <tr>
                                        <td colspan="5" class="px-4 py-4 text-sm font-medium text-gray-200 whitespace-nowrap text-center">
                                            No data found.
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($admins as $item)
                                        <tr>
                                            <td class="px-4 py-4 text-sm font-medium text-gray-200 whitespace-nowrap">
                                                <div class="inline-flex items-center gap-x-3">
                                                    <span>{{$item->lastname}}, {{$item->firstname}} {{$item->middlename}}</span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">{{$item->gender}}</td>
                                            <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">
                                                <h2 class="text-sm font-normal">{{$item->email}}</h2>
                                            </td>
                                            <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">
                                                <div class="flex items-center gap-x-2">
                                                    <img class="object-cover w-10 h-10 " src="{{ asset('storage/' . $item->photo) }}" alt="">
                                                </div>
                                            </td>
                                            <td class="px-1 py-4 text-sm whitespace-nowrap">
                                                <div class="flex items-center gap-x-6">
                                                    <a href="/admin/dashboard/admin/view/{{$item->id}}" title="View Admin">
                                                        <button class=" transition-colors duration-200 hover:text-whitebg text-gray-300  focus:outline-none">
                                                            View
                                                        </button>
                                                    </a>
                                                    <a href="/admin/dashboard/admin/edit/{{$item->id}}" title="Edit Admin">
                                                        <button onclick="return confirm('Update the data?');" class="transition-colors duration-200 hover:text-whitebg text-gray-300  focus:outline-none">
                                                            Update
                                                        </button>
                                                    </a>
                                                    <form action="/admin/dashboard/admin/delete/{{$item->id}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick="return confirm('Permanent Delete?');" class="text-red-700 transition-colors duration-200 hover:text-white focus:outline-none sm:pr-0 pr-2">
                                                            Delete
                                                        </button>
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
                            <!-- Conditional display of Previous Button -->
                            @if ($admins->lastPage() > 1)
                                @if ($admins->onFirstPage())
                                    <span class="flex items-center justify-center mr-3 px-3 h-8 text-sm font-medium text-gray-500  border rounded-lg bg-gray-800 border-gray-700 text-gray-400">Previous</span>
                                @else
                                    <a href="{{ $admins->previousPageUrl() }}" class="flex mr-3 items-center justify-center px-3 h-8 text-sm font-medium text-gray-500  border rounded-lg border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">Previous</a>
                                @endif
                            @endif
                    
                            <!-- Pagination Links -->
                            <ul class="flex items-center -space-x-px h-8 text-sm">
                                @if ($admins->hasPages())
                                    @foreach ($admins->links()->elements as $element)
                                        @if (is_string($element))
                                            <li>
                                                <span class="flex items-center justify-center px-3 h-8 leading-tight border bg-gray-800 border-gray-700 text-gray-400">{{ $element }}</span>
                                            </li>
                                        @endif
                                        @if (is_array($element))
                                            @foreach ($element as $page => $url)
                                                @if ($page == $admins->currentPage())
                                                    <li>
                                                        <span class="flex items-center justify-center px-3 h-8 leading-tight border bg-gray-800 border-gray-700 text-gray-400">{{ $page }}</span>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ $url }}" class="flex items-center justify-center px-3 h-8 leading-tight border border-gray-300 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">{{ $page }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                    
                            <!-- Conditional display of Next Button -->
                            @if ($admins->lastPage() > 1)
                                @if ($admins->hasMorePages())
                                    <a href="{{ $admins->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 ml-3 text-sm font-medium border rounded-lg hover:bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">Next</a>
                                @else
                                    <span class="flex items-center justify-center px-3 h-8 ml-3 text-sm font-medium border rounded-lg bg-gray-800 border-gray-700 text-gray-400">Next</span>
                                @endif
                            @endif
                        </div>
                    </nav>
                    
                </div>
            </div>
        </div>
    </section>
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