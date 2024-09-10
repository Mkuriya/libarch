@include('partials.studentnav')
<div class="content px-10">
    <div class="mt-6 mb-4 md:flex md:items-center  flex justify-between">
        <div class="ml-auto mb-2 text-white mr-6 w-96 border-b-2 border-black">
            <form action="{{ url('/student/dashboard/archivelist/filter') }}" id="searchForm" method="get" class="max-w-md mx-auto ">   
                <label for="default-search" class="mb-2 text-sm font-medium sr-only text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center p-2">
                        <a href="/student/dashboard/archivelist/filter">
                            <button type="button" class=" text-white font-medium rounded-lg text-sm  py-2 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                <svg class="w-6 h-6  hover:text-whitebg text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
                                  </svg>                                  
                            </button>
                        </a>
                    </div>
                    
                    <input type="search" id="default-search" value="{{ request()->input('search') }}" name="search" class="block w-full p-4 ps-10 text-sm text-white focus:outline-none bg-transparent" placeholder="Search Title / Description" />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-whitebg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
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
                                     Description
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
                            @foreach ($files as $item)
                                @if ($item->status == 1)
                                    <tr>
                                        
                                        <td class="px-4 py-4 text-sm text-gray-300 ">
                                            <span>{{ \Illuminate\Support\Str::words($item->title, 10, '...') }}</span>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-300 ">
                                            {{$item->year}}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-300 ">
                                                <h2 class="text-sm font-normal">{{ \Illuminate\Support\Str::words($item->abstract, 10, '...') }}</h2>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-300 ">
                                                <h2 class="text-sm font-normal">{{ \Illuminate\Support\Str::words($item->description, 10, '...') }}</h2>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-sky-300 ">
                                            {{$item->student_department}}
                                        </td>
                                    
                                        <td class="px-1 py-4 text-sm "> <!-- for viewer botton-->
                                            <a href="/student/dashboard/archivelist/document/{{$item->id}}">
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
@include('partials.footer')