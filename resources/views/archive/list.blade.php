@include('partials.adminnav')
<div class="content px-10">
    <div class="mt-6 mb-4 md:flex md:items-center md:justify-between">
        <div class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">
            <ul class="flex">
                <li class="mr-3">
                    <a class="inline-block rounded py-1.5 px-3  text-white border-b border-b-4 border-white" href="/admin/dashboard/archive">Archive List</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block rounded py-1.5 px-3  text-white " href="/admin/dashboard/archive/pending">Pending List</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block rounded py-1.5 px-3  text-white " href="/admin/dashboard/archive/decline">Decline List</a>
                </li>
            </ul>
        </div>
        <div class="mb-2 text-white  w-96 border-b-2 border-black">
            <form action="{{ url('/admin/dashboard/archive') }}" id="searchForm" method="get" class="max-w-md mx-auto">   
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
    <hr><br>
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
                                             <span>Title</span>
                                         </button>
                                     </div>
                                 </th>
 
                                 <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                     Year
                                 </th>
 
                                 <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                     Uploader
                                 </th>
 
                                 <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                     Department
                                 </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                     Action
                                 </th> 
                             </tr>
                         </thead>
                         <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($files as $item)
                                @if ($item->status == 1)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap">
                                            <div class="inline-flex items-center gap-x-3">
                                            
                                                <span>{{$item->title}}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            {{$item->year}}
                                        </td>
                                        <td class="px-4 py-4 text-sm ext-gray-500 dark:text-gray-300 whitespace-nowrap">
                                                <h2 class="text-sm font-normal">{{$item->student->firstname}}</h2>
                                            
                                        </td>
                                        <td class="px-4 py-4 text-sm ext-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            @if ($item->student->department == "Marketing & Entrepreneurship")
                                                <h1 class="text-red-400">Marketing & Entrepreneurship</h1>
                                            @elseif($item->student->department == "Engineering")
                                                <p class="text-sky-800">Engineering</p>
                                            @elseif($item->student->department == "Information Technology")
                                                <p class="text-purple-800">Information Technology</p>
                                            @elseif($item->student->department == "Tourism")
                                                <p class="text-gray-800">Tourism</p>
                                            @elseif($item->student->department == "Education")
                                                <p class="text-sky-300">Education</p>
                                            @elseif($item->student->department == "Psychology")
                                                <p class="text-sky-300">Psychology</p>
                                            @endif
                                        </td>
                                        <td class="px-1 py-4 text-sm whitespace-nowrap"> <!-- for viewer botton-->
                                            <a href="/admin/dashboard/archive/view/{{$item->id}}">
                                                <button class="hover:border-indigo-500 text-white hover:text-indigo-500 font-bold py-2 px-4 rounded-full">View</button>
                                            </a>
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
                        @if ($files->onFirstPage())
                            <span class="flex items-center justify-center mr-3 px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">Previous</span>
                        @else
                            <a href="{{ $files->previousPageUrl() }}" class="flex mr-3 items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                        @endif
                        <ul class="flex items-center -space-x-px h-8 text-sm">
                            @if ($files->hasPages())
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
                            @endif
                        </ul>
                        <!-- Next Button -->
                        @if ($files->hasMorePages())
                            <a href="{{ $files->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                        @else
                            <span class="flex items-center justify-center px-3 h-8 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">Next</span>
                        @endif
                    </div>
                </nav>
             </div>
         </div>
     </div>
@include('partials.footer')