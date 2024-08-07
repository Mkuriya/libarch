@include('partials.adminnav')
<div class="content px-10">
    <div class="mt-6 mb-4 md:flex md:items-center md:justify-between">
        <div class="inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-gray-900 rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">
            <ul class="flex">
                <li class="mr-3">
                    <a class="inline-block rounded py-1.5 px-3  text-white " href="/admin/dashboard/archive">Archive List</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block rounded py-1.5 px-3  text-white " href="/admin/dashboard/archive/pending">Pending List</a>
                </li>
                <li class="">
                    <a class="inline-block rounded py-1.5 px-3  text-white border-b border-b-4 border-white" href="/admin/dashboard/archive/decline">Decline List</a>
                </li>
            </ul>
        </div>
        <div class="text-white w-full h-12 sm:w-2/6 ">
            <form action="{{ url('/admin/dashboard/archive/decline') }}" id="searchForm" method="get" class=" w-full mx-auto h-full">
                <div class="flex flex-row mt-2 sm:mt-0 md:flex-row items-center h-full">
                    <div class="relative h-full">
                        <select id="dropdown" class="text-white w-full md:w-36 bg-whitebg hover:bg-gray-800 font-medium text-sm px-2 py-4 md:py-0 h-full rounded-lg-g md:rounded-l-lg" name="department">
                            <option value="" {{ request()->input('department') ? '' : 'selected' }}>Department</option>
                            <option value="Marketing & Entrepreneurship" {{ request()->input('department') === 'Marketing & Entrepreneurship' ? 'selected' : '' }}>Marketing & Entrepreneurship</option>
                            <option value="Engineering" {{ request()->input('department') === 'Engineering' ? 'selected' : '' }}>Engineering</option>
                            <option value="Information Technology" {{ request()->input('department') === 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                            <option value="Tourism" {{ request()->input('department') === 'Tourism' ? 'selected' : '' }}>Tourism</option>
                            <option value="Education" {{ request()->input('department') === 'Education' ? 'selected' : '' }}>Education</option>
                            <option value="Psychology" {{ request()->input('department') === 'Psychology' ? 'selected' : '' }}>Psychology</option>
                        </select>
                    </div>
                    <input type="search" id="default-search" value="{{ request()->input('search') }}" name="search" class="w-full p-4 text-sm text-white bg-transparent hover:bg-gray-800 focus:outline-none md:py-0 h-full md:border-b-2 md:border-t-2 border-y-2 border-whitebg md:border-whitebg " placeholder="Search Name" />
                    <button type="submit" class="text-white bg-whitebg hover:bg-gray-800 font-medium text-sm px-4 py-4 md:py-0 h-full rounded-lg-g md:rounded-r-lg">Search</button>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <br>
    <div class="flex flex-col">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 ">
              <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                 <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Title </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Year </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Uploader </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Department </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Status </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">Action </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @forelse ($files as $item)
                                @if ($item->status == 2)
                                    <tr>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            {{$item->title}}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            {{$item->year}}
                                        </td>
                                        <td class="px-4 py-4 text-sm ext-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            <h2 class="text-sm font-normal">{{$item->student->firstname}}</h2>
                                        </td>
                                        <td class="px-4 py-4 text-sm ext-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            @if ($item->student->department == "Marketing & Entrepreneurship")
                                                <h1 class="text-yellow-300">Marketing & Entrepreneurship</h1>
                                            @elseif($item->student->department == "Engineering")
                                                <p class="text-black">Engineering</p>
                                            @elseif($item->student->department == "Information Technology")
                                                <p class="text-gray-300">Information Technology</p>
                                            @elseif($item->student->department == "Tourism")
                                                <p class="text-purple-300">Tourism</p>
                                            @elseif($item->student->department == "Education")
                                                <p class="text-sky-200">Education</p>
                                            @elseif($item->student->department == "Psychology")
                                                <p class="text-green-300">Psychology</p>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                            <div class="flex items-center gap-x-2">
                                                @if($item->status == 0)
                                                    <h1 class="text-sky-200">Pending</h1>
                                                @elseif($item->status == 1)
                                                    <h1 class="text-green-400">Approve</h1>
                                                @else
                                                    <h1 class="text-red-400">Decline</h1>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-1 py-4 text-sm whitespace-nowrap">
                                            <button class="modal-open hover:border-red-600 text-white hover:text-whitebg font-bold py-2 px-4 rounded-full">Update</button>
                                            <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
                                                <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
                                                <div class="modal-container bg-whitebg text-white w-10/12 md:max-w-4xl mx-auto rounded shadow-lg z-50 overflow-y-auto">
                                                    <div class="modal-content py-4 text-left px-6">
                                                        <div class="flex justify-between items-center pb-3">
                                                            <p class="text-2xl font-bold">Book Information!</p>
                                                            <div class="modal-close cursor-pointer z-50"></div>
                                                        </div>
                                                        <div class="bg-gray-500 border-2 border-white p-2">
                                                            <form action="/admin/dashboard/archive/pending/status/{{$item->id}}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">
                                                                    <div class="col-span-12 sm:col-span-10">
                                                                        <label class="text-white dark:text-gray-200 pl-2" for="lastname">Title</label>
                                                                        <input value="{{$item->title}}" disabled type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                                    </div>
                                                                    <div class="col-span-12 sm:col-span-2">
                                                                        <label class="text-white dark:text-gray-200 pl-2" for="firstname">Year</label>
                                                                        <input value="{{$item->year}}" disabled type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                                    </div>
                                                                </div>
                                                                <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">
                                                                    <div class="col-span-12 sm:col-span-10">
                                                                        <label class="text-white dark:text-gray-200 pl-2" for="lastname">Department</label>
                                                                        <input value="{{$item->student->department}}" disabled type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                                    </div>
                                                                    <div class="col-span-12 sm:col-span-2">
                                                                        <label class="text-white dark:text-gray-200 pl-2" for="firstname">Status</label>
                                                                        <select name="status" id="" class="block w-full px-2 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                                            <option value="0" {{$item->status == '0' ? 'selected' : ''}}>Pending</option>
                                                                            <option value="1" {{$item->status == '1' ? 'selected' : ''}}>Approve</option>
                                                                            <option value="2" {{$item->status == '2' ? 'selected' : ''}}>Decline</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="flex justify-center sm:justify-end pt-2">
                                                                    <button type="submit" class="px-4 bg-whitebg p-3 rounded-lg text-white hover:bg-gray-800 mr-2">Update</button>
                                                                    <button type="button" class="modal-close px-4 bg-whitebg p-3 rounded-lg text-white hover:bg-gray-800">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-sm font-medium text-gray-700 dark:text-gray-200 whitespace-nowrap text-center">
                                        No data available.
                                    </td>
                                </tr>
                            @endforelse
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
@include('partials.footer')