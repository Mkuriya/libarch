@include('partials.adminnav')
<div class="content px-10">
    <div class="mt-6 mb-4 md:flex md:items-center md:justify-between">
        <div class="inline-flex overflow-hidden border divide-x rounded-lg bg-gray-900 rtl:flex-row-reverse border-gray-700 divide-gray-700">
            <ul class="flex">
                <li class="mr-3">
                    <a class="inline-block rounded py-1.5 px-3  text-white border-b border-b-4 border-white" href="/admin/dashboard/archive">Archive List</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block rounded py-1.5 px-3  text-white " href="/admin/dashboard/archive/pending">Pending List</a>
                </li>
                <li class="">
                    <a class="inline-block rounded py-1.5 px-3  text-white " href="/admin/dashboard/archive/decline">Decline List</a>
                </li>
            </ul>
        </div>
        <div class="text-white w-full h-12 sm:w-2/6 ">
            <form action="{{ url('/admin/dashboard/archive') }}" id="searchForm" method="get" class=" w-full mx-auto h-full">
                <div class="flex flex-row mt-2 sm:mt-0 md:flex-row items-center h-full">
                    <div class="relative h-full">
                        <select id="dropdown" class="text-white w-full md:w-36 bg-whitebg hover:bg-gray-800 font-medium text-sm px-2 py-4 md:py-0 h-full rounded-lg-g md:rounded-l-lg" name="student_department">
                            <option value="" {{ request()->input('student_department') ? '' : 'selected' }}>Department</option>
                            <option value="Marketing & Entrepreneurship" {{ request()->input('student_department') === 'Marketing & Entrepreneurship' ? 'selected' : '' }}>Marketing & Entrepreneurship</option>
                            <option value="Engineering" {{ request()->input('student_department') === 'Engineering' ? 'selected' : '' }}>Engineering</option>
                            <option value="Information Technology" {{ request()->input('student_department') === 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                            <option value="Tourism" {{ request()->input('student_department') === 'Tourism' ? 'selected' : '' }}>Tourism</option>
                            <option value="Education" {{ request()->input('student_department') === 'Education' ? 'selected' : '' }}>Education</option>
                            <option value="Psychology" {{ request()->input('student_department') === 'Psychology' ? 'selected' : '' }}>Psychology</option>
                        </select>
                    </div>
                    <input type="search" id="default-search" value="{{ request()->input('search') }}" name="search" class="w-full p-4 text-sm text-white bg-transparent hover:bg-gray-800 focus:outline-none md:py-0 h-full md:border-b-2 md:border-t-2 border-y-2 border-whitebg md:border-whitebg " placeholder="Search Title" />
                    <button type="submit" class="text-white bg-whitebg hover:bg-gray-800 font-medium text-sm px-4 py-4 md:py-0 h-full rounded-lg-g md:rounded-r-lg">Search</button>
                </div>
            </form>
        </div>
    </div>
    <hr><br>
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
                                            <span>Title</span>
                                        </button>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                    Year
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                    Uploader
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                    Department
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                    Updated At
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700 bg-gray-900">
                            @forelse ($files as $item)
                                @if ($item->status == 1)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium text-gray-300 whitespace-nowrap">
                                            <div class="inline-flex items-center gap-x-3">
                                                <span>{{ \Illuminate\Support\Str::words($item->title, 10, '...') }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">
                                            {{$item->year}}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">
                                            <h2 class="text-sm font-normal">{{$item->student_firstname}} {{$item->student_lastname}}</h2>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">
                                            @if ($item->student_department == "Marketing & Entrepreneurship")
                                                <h1 class="text-white">Marketing & Entrepreneurship</h1>
                                            @elseif($item->student_department == "Engineering")
                                                <p class="text-white">Engineering</p>
                                            @elseif($item->student_department == "Information Technology")
                                                <p class="text-white">Information Technology</p>
                                            @elseif($item->student_department == "Tourism")
                                                <p class="text-white">Tourism</p>
                                            @elseif($item->student_department == "Education")
                                                <p class="text-white">Education</p>
                                            @elseif($item->student_department == "Psychology")
                                                <p class="text-white">Psychology</p>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">{{ \Carbon\Carbon::parse($item->updated_at)->format('Y-m-d') }}</td>
                                        <td class="px-1 py-4 text-sm whitespace-nowrap">
                                            <a href="/admin/dashboard/archive/view/{{$item->id}}">
                                                <button class="hover:border-indigo-500 text-white hover:text-whitebg font-bold py-2 px-4 rounded-full">View</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-4 text-sm font-medium text-gray-200 whitespace-nowrap text-center">
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
                                <span class="flex items-center justify-center mr-3 px-3 h-8 text-sm font-medium border rounded-lg bg-gray-800 border-gray-700 text-gray-400">Previous</span>
                            @else
                                <a href="{{ $files->previousPageUrl() }}" class="flex mr-3 items-center justify-center px-3 h-8 text-sm font-medium border rounded-lg bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">Previous</a>
                            @endif
                
                            <ul class="flex items-center -space-x-px h-8 text-sm">
                                @foreach ($files->links()->elements as $element)
                                    @if (is_string($element))
                                        <li>
                                            <span class="flex items-center justify-center px-3 h-8 leading-tight border bg-gray-800 border-gray-700 text-gray-400">{{ $element }}</span>
                                        </li>
                                    @endif
                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $files->currentPage())
                                                <li>
                                                    <span class="flex items-center justify-center px-3 h-8 leading-tight border bg-gray-800 border-gray-700 text-gray-400">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ $url }}" class="flex items-center justify-center px-3 h-8 leading-tight border bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </ul>
                
                            <!-- Next Button -->
                            @if ($files->hasMorePages())
                                <a href="{{ $files->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 ml-3 text-sm font-medium border rounded-lg bg-gray-800 border-gray-700 text-gray-400 hover:bg-gray-700 hover:text-white">Next</a>
                            @else
                                <span class="flex items-center justify-center px-3 h-8 ml-3 text-sm font-medium border rounded-lg bg-gray-800 border-gray-700 text-gray-400">Next</span>
                            @endif
                        </div>
                    @endif
                </nav> 
             </div>
         </div>
     </div>
     <script>
        document.getElementById('dropdownButton').addEventListener('click', function() {
            document.getElementById('dropdown').classList.toggle('hidden');
        });
    </script>
@include('partials.footer')