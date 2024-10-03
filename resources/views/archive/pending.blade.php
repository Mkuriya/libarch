@include('partials.adminnav')
<div class="content px-10">
    <div class="mt-6 mb-4 md:flex md:items-center md:justify-between">
        <div class="inline-flex overflow-hidden border divide-x rounded-lg bg-gray-900 rtl:flex-row-reverse border-gray-700 divide-gray-700">
            <ul class="flex">
                <li class="mr-3">
                    <a class="inline-block rounded py-1.5 px-3  text-white " href="/admin/dashboard/archive">Archive List</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block rounded py-1.5 px-3  text-white border-b border-b-4 border-white" href="/admin/dashboard/archive/pending">Pending List</a>
                </li>
                <li class="">
                    <a class="inline-block rounded py-1.5 px-3  text-white " href="/admin/dashboard/archive/decline">Decline List</a>
                </li>
            </ul>
        </div>
         <div class="text-white w-full h-12 sm:w-2/6 ">
            <form action="{{ url('/admin/dashboard/archive/pending') }}" id="searchForm" method="get" class=" w-full mx-auto h-full">
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
    <hr>
    <br>
    <div class="flex flex-col">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-700 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-800">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-400">Title</th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">Year</th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">Uploader</th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">Department</th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">Status</th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-400">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700 bg-gray-900">
                            @forelse ($files as $item)
                                @if ($item->status == 0)
                                    <tr>
                                        <td class="px-4 py-4 text-sm font-medium text-gray-200 whitespace-nowrap">
                                            <div class="inline-flex items-center gap-x-3">
                                                <span>{{ \Illuminate\Support\Str::words($item->title, 10, '...') }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">{{ $item->year }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">{{ $item->student_firstname }} {{ $item->student_lastname }}</td>
                                        <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">
                                            <div class="flex items-center gap-x-2">
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
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-300 whitespace-nowrap">
                                            <div class="flex items-center gap-x-2">
                                                @if($item->status == 0)
                                                    <h1 class="text-sky-200">Pending</h1>
                                                @elseif($item->status == 1)
                                                    <h1 class="text-green-400">Approve</h1>
                                                @else
                                                    <h1 class="text-rose-400">Decline</h1>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-1 py-4 text-sm whitespace-nowrap">
                                            <!-- Pass data to the modal -->
                                            <button class="modal-open hover:border-red-600 text-white hover:text-whitebg font-bold py-2 px-4 rounded-full"
                                                data-title="{{ $item->title }}"
                                                data-year="{{ $item->year }}"
                                                data-department="{{ $item->student_department }}"
                                                data-status="{{ $item->status }}"
                                                data-id="{{ $item->id }}">
                                                Update
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-sm text-center text-gray-300">
                                        No data available.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Logic -->
                <nav aria-label="Page navigation example" class="mt-4 grid justify-items-center">
                    <!-- Your existing pagination here -->
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal HTML -->
    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        <div class="modal-container bg-gray-800 border-2 border-white text-white w-10/12 md:max-w-4xl mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Book Information!</p>
                    <div class="modal-close cursor-pointer hover:text-red-400  z-50">X</div>
                </div>
                <div class="p-2">
                    <form id="updateForm" action="/admin/dashboard/archive/pending/status/" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-6 mt-4 sm:grid-cols-12">
                            <div class="col-span-2 sm:col-span-10">
                                <label class="text-gray-200 pl-2" for="title">Title</label>
                                <input id="modal-title" disabled type="text" class="block w-full px-4 py-2 mt-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-blue-500 focus:outline-none focus:ring">
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <label class="text-gray-200 pl-2" for="year">Year</label>
                                <input id="modal-year" disabled type="text" class="block w-full px-4 py-2 mt-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-blue-500 focus:outline-none focus:ring">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-6 mt-4 sm:grid-cols-12">
                            <div class="col-span-2 sm:col-span-10">
                                <label class="text-gray-200 pl-2" for="department">Department</label>
                                <input id="modal-department" disabled type="text" class="block w-full px-4 py-2 mt-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-blue-500 focus:outline-none focus:ring">
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <label class="text-gray-200 pl-2" for="status">Status</label>
                                <select id="modal-status" name="status" class="block w-full px-2 py-2 mt-2 border rounded-md bg-gray-800 text-gray-300 border-gray-600 focus:border-blue-500 focus:outline-none focus:ring">
                                    <option value="0">Pending</option>
                                    <option value="1">Approve</option>
                                    <option value="2">Decline</option>
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
</div>

<!-- Modal Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the modal
        var modal = document.querySelector('.modal');

        // Get all buttons that open the modal
        var openModalButtons = document.querySelectorAll('.modal-open');

        // Get close button
        var closeModalButtons = document.querySelectorAll('.modal-close');

        openModalButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Get the data attributes from the clicked button
                var title = button.getAttribute('data-title');
                var year = button.getAttribute('data-year');
                var department = button.getAttribute('data-department');
                var status = button.getAttribute('data-status');
                var id = button.getAttribute('data-id');

                // Populate the modal with the data
                document.getElementById('modal-title').value = title;
                document.getElementById('modal-year').value = year;
                document.getElementById('modal-department').value = department;
                document.getElementById('modal-status').value = status;

                // Update form action to point to the correct URL for the selected item
                var form = document.getElementById('updateForm');
                form.action = '/admin/dashboard/archive/pending/status/' + id;

                // Show the modal
                modal.classList.remove('opacity-0');
                modal.classList.remove('pointer-events-none');
            });
        });

        closeModalButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Hide the modal
                modal.classList.add('opacity-0');
                modal.classList.add('pointer-events-none');
            });
        });

        // Close the modal when clicking outside of it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.classList.add('opacity-0');
                modal.classList.add('pointer-events-none');
            }
        };
    });
</script>
@include('partials.footer')