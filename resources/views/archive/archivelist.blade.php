@include('partials.studentnav')
<div class="content px-10">
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
                                     Abstract
                                 </th>
 
                                 <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                     Action
                                 </th>
                             </tr>
                         </thead>
                         <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach ($file as $item)
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
                                                <h2 class="text-sm font-normal">{{$item->abstract}}</h2>
                                            
                                        </td>
                                    
                                        <td class="px-1 py-4 text-sm whitespace-nowrap"> <!-- for update botton-->
                                            <button class="hover:border-indigo-500 text-white hover:text-indigo-500 font-bold py-2 px-4 rounded-full">View</button>
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