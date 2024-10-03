{{--@include('partials.adminnav')
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
                                                        <button class="transition-colors duration-200 hover:text-whitebg text-gray-300  focus:outline-none">
                                                            View
                                                        </button>
                                                    </a>
                                                    <a href="/admin/dashboard/admin/edit/{{$item->id}}" title="Edit Admin">
                                                        <button onclick="return confirm('Update the data?');" class="transition-colors duration-200 hover:text-whitebg text-gray-300  focus:outline-none">
                                                            Update
                                                        </button>
                                                    </a>
                                                    @if(auth()->guard('admin')->user()->id == 1)
                                                        <form action="/admin/dashboard/admin/delete/{{$item->id}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick="return confirm('Permanent Delete?');" class="text-red-700 transition-colors duration-200 hover:text-white focus:outline-none sm:pr-0 pr-2">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endif
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

--}}
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
                                                    <a href="/admin/dashboard/admin/view/{{$item->id}}" title="View Account">
                                                        <button class="transition-colors duration-200 hover:text-whitebg text-gray-300  focus:outline-none">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <circle cx="12" cy="12" r="1" stroke="#fff" stroke-width="2"/>
                                                                <path d="M18.2265 11.3805C18.3552 11.634 18.4195 11.7607 18.4195 12C18.4195 12.2393 18.3552 12.366 18.2265 12.6195C17.6001 13.8533 15.812 16.5 12 16.5C8.18799 16.5 6.39992 13.8533 5.77348 12.6195C5.64481 12.366 5.58048 12.2393 5.58048 12C5.58048 11.7607 5.64481 11.634 5.77348 11.3805C6.39992 10.1467 8.18799 7.5 12 7.5C15.812 7.5 17.6001 10.1467 18.2265 11.3805Z" stroke="#fff" stroke-width="2"/>
                                                                <path d="M17 4H17.2C18.9913 4 19.887 4 20.4435 4.5565C21 5.11299 21 6.00866 21 7.8V8M17 20H17.2C18.9913 20 19.887 20 20.4435 19.4435C21 18.887 21 17.9913 21 16.2V16M7 4H6.8C5.00866 4 4.11299 4 3.5565 4.5565C3 5.11299 3 6.00866 3 7.8V8M7 20H6.8C5.00866 20 4.11299 20 3.5565 19.4435C3 18.887 3 17.9913 3 16.2V16" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                                                            </svg>
                                                        </button>
                                                    </a>
                                                    <a href="/admin/dashboard/admin/edit/{{$item->id}}" title="Edit Account">
                                                        <button onclick="return confirm('Update the data?');" class="transition-colors duration-200 hover:text-whitebg text-gray-300  focus:outline-none">
                                                            <svg fill="#fff" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M2,21H8a1,1,0,0,0,0-2H3.071A7.011,7.011,0,0,1,10,13a5.044,5.044,0,1,0-3.377-1.337A9.01,9.01,0,0,0,1,20,1,1,0,0,0,2,21ZM10,5A3,3,0,1,1,7,8,3,3,0,0,1,10,5ZM20.207,9.293a1,1,0,0,0-1.414,0l-6.25,6.25a1.011,1.011,0,0,0-.241.391l-1.25,3.75A1,1,0,0,0,12,21a1.014,1.014,0,0,0,.316-.051l3.75-1.25a1,1,0,0,0,.391-.242l6.25-6.25a1,1,0,0,0,0-1.414Zm-5,8.583-1.629.543.543-1.629L19.5,11.414,20.586,12.5Z"/>
                                                            </svg>
                                                        </button>
                                                    </a>
                                                    @if(auth()->guard('admin')->user()->id == 1)
                                                        <form action="/admin/dashboard/admin/delete/{{$item->id}}" method="post" title="Delete Account">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick="return confirm('Permanent Delete?');" class="text-red-700 transition-colors duration-200 hover:text-white focus:outline-none sm:pr-0 pr-2">
                                                                 <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" x="0px" y="0px" width="30" height="30" viewBox="0 0 32 32">
                                                                    <path d="M 15 4 C 14.476563 4 13.941406 4.183594 13.5625 4.5625 C 13.183594 4.941406 13 5.476563 13 6 L 13 7 L 7 7 L 7 9 L 8 9 L 8 25 C 8 26.644531 9.355469 28 11 28 L 23 28 C 24.644531 28 26 26.644531 26 25 L 26 9 L 27 9 L 27 7 L 21 7 L 21 6 C 21 5.476563 20.816406 4.941406 20.4375 4.5625 C 20.058594 4.183594 19.523438 4 19 4 Z M 15 6 L 19 6 L 19 7 L 15 7 Z M 10 9 L 24 9 L 24 25 C 24 25.554688 23.554688 26 23 26 L 11 26 C 10.445313 26 10 25.554688 10 25 Z M 12 12 L 12 23 L 14 23 L 14 12 Z M 16 12 L 16 23 L 18 23 L 18 12 Z M 20 12 L 20 23 L 22 23 L 22 12 Z"></path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif
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
                                    <span class="flex items-center justify-center mr-3 px-3 h-8 text-sm font-medium text-gray-500 border rounded-lg bg-gray-800 border-gray-700 text-gray-400">Previous</span>
                                @else
                                    <a href="{{ $admins->previousPageUrl() }}" class="flex mr-3 items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 border rounded-lg border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">Previous</a>
                                @endif
                            @endif
                    
                            <!-- Pagination Links -->
                            <ul class="flex items-center -space-x-px h-8 text-sm">
                                @if ($admins->hasPages())
                                    @php
                                        $start = max($admins->currentPage() - 2, 1);
                                        $end = min($admins->currentPage() + 2, $admins->lastPage());
                                    @endphp
                        
                                    <!-- Display the first page and ellipsis if current page is far from the first page -->
                                    @if ($start > 1)
                                        <li>
                                            <a href="{{ $admins->url(1) }}" class="flex items-center justify-center px-3 h-8 leading-tight border bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">1</a>
                                        </li>
                                        @if ($start > 2)
                                            <li>
                                                <span class="flex items-center justify-center px-3 h-8 leading-tight border bg-gray-800 border-gray-700 text-gray-400">...</span>
                                            </li>
                                        @endif
                                    @endif
                        
                                    <!-- Display page numbers -->
                                    @for ($i = $start; $i <= $end; $i++)
                                        @if ($i == $admins->currentPage())
                                            <li>
                                                <span class="flex items-center justify-center px-3 h-8 leading-tight border bg-gray-800 border-gray-700 text-gray-400">{{ $i }}</span>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ $admins->url($i) }}" class="flex items-center justify-center px-3 h-8 leading-tight border bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">{{ $i }}</a>
                                            </li>
                                        @endif
                                    @endfor
                        
                                    <!-- Display the last page and ellipsis if current page is far from the last page -->
                                    @if ($end < $admins->lastPage())
                                        @if ($end < $admins->lastPage() - 1)
                                            <li>
                                                <span class="flex items-center justify-center px-3 h-8 leading-tight border bg-gray-800 border-gray-700 text-gray-400">...</span>
                                            </li>
                                        @endif
                                        <li>
                                            <a href="{{ $admins->url($admins->lastPage()) }}" class="flex items-center justify-center px-3 h-8 leading-tight border bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">{{ $admins->lastPage() }}</a>
                                        </li>
                                    @endif
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
