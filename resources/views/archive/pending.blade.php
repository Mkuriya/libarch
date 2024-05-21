@include('partials.adminnav')
<div class="content px-10">
    <div class="text-xl font-bold text-white capitalize dark:text-white px-2 py-4 grid grid-cols-12 gap-6 mb-4 sm:grid-cols-12">
        <p class="absolute left-12"><a href="/admin/dashboard/archive">Archive List</a></p>
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
                                     Book Cover
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
                                         <h2 class="text-sm font-normal">{{$item->student->department}}</h2>
                                     
                                 </td>
                                 <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                     <div class="flex items-center gap-x-2">
                                         <img class="object-cover w-10 h-10 " src="{{ asset($item->banner) }}" alt="">
                                     </div>
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
                                    <a href="/admin/dashboard/archive/pending/edit/{{$item->id}}"   title="Edit Admin">
                                        <button class="text-gray-500 transition-colors duration-200 dark:hover:text-indigo-500 dark:text-gray-300 hover:text-indigo-500 focus:outline-none">
                                            Update
                                        </button>
                                    </a>
                                    
                                 </td>
                             </tr>
                             @endforeach
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>


@include('partials.footer')