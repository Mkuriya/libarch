@include('partials.adminnav')
<div class="content px-10">
    <div class="text-xl text-white px-2 pt-4  ">
        <ul class="flex">
            <li class="mr-3">
                <a class="inline-block rounded py-1 px-3  text-white " href="/admin/dashboard/archive">Archive List</a>
            </li>
            <li class="mr-3">
                <a class="inline-block rounded py-1 px-3  text-white " href="/admin/dashboard/archive/pending">Pending List</a>
            </li>
            <li class="mr-3">
                <a class="inline-block rounded py-1 px-3  text-white border-b border-b-4 border-white" href="/admin/dashboard/archive/decline">Decline List</a>
            </li>
        </ul>
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
                                     Status
                                 </th>
                                 <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                     Action
                                 </th>
                             </tr>
                         </thead>
                         <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($file as $item)
                                @if ($item->status == 2)
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
                                                <h1 class="text-rose-400">Decline</h1>
                                            @endif
                                            
                                            </div>
                                        </td>
                                        <td class="px-1 py-4 text-sm whitespace-nowrap"> <!-- for update botton-->
                                        <button class="modal-open  hover:border-indigo-500 text-white hover:text-indigo-500 font-bold py-2 px-4 rounded-full">Update</button>
                                        <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
                                            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
                                            
                                            <div class="modal-container bg-white w-10/12 md:max-w-4xl mx-auto rounded shadow-lg z-50 overflow-y-auto">
                                                <!-- Add margin if you want to see some of the overlay behind the modal-->
                                                <div class="modal-content py-4 text-left px-6">
                                                <!--Title-->
                                                <div class="flex justify-between items-center pb-3">
                                                    <p class="text-2xl font-bold">Book Information!</p>
                                                    <div class="modal-close cursor-pointer z-50">
                                                    
                                                    </div>
                                                </div>
                                                <div class="bg-gray-500 border-2 border-sky-600 p-2">
                                                    <form action="/admin/dashboard/archive/pending/status/{{$item->id}}" method="POST">
                                                        @csrf
                                                        @method('PUT') 
                                                        <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">   
                                                            <div class="col-span-10">
                                                                <label class="text-white dark:text-gray-200 pl-2" for="lastname">Title</label>
                                                                <input value="{{$item->title}}" readonly type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                            </div>
                                                            <div class="col-span-2">
                                                                <label class="text-white dark:text-gray-200 pl-2" for="firstname">Year</label>
                                                                <input value="{{$item->year}}" readonly type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-3 gap-6 mt-4 sm:grid-cols-12">   
                                                            <div class="col-span-10">
                                                                <label class="text-white dark:text-gray-200 pl-2" for="lastname">Department</label>
                                                                <input value="{{$item->student->department}}" readonly type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                            </div>
                                                            <div class="col-span-2">
                                                                <label class="text-white dark:text-gray-200 pl-2" for="firstname">Status</label>
                                                                <select name="status" id="" class="block w-full px-2 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                                                                    <option value="0" {{$item->status == '0' ? 'selected' : ''}}>Pending</option>
                                                                    <option value="1" {{$item->status == '1' ? 'selected' : ''}}>Approve</option>
                                                                    <option value="2" {{$item->status == '2' ? 'selected' : ''}}>Decline</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="flex justify-end pt-2">
                                                            <button type="submit" class="px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400  mr-2">Update</button>
                                                            <button type="button" class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button>
                                                            </div>
                                                    </form>
                                                    
                                                </div>
                                                <!--Footer-->
                                                
                                                
                                                </div>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>    
                                @endif
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
@include('partials.footer')