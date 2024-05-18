@include('partials.adminnav')
<div class="content px-10">
    <div class="text-xl font-bold text-white capitalize dark:text-white px-2 py-4 grid grid-cols-12 gap-6 mb-4 sm:grid-cols-12">
        <p class="absolute left-12">Archive List</p>
        <button class="absolute right-12 bg-whitebg hover:bg-gray-600 rounded-full px-8">Pending List</button>
        </div>
    <hr>
    <div class="grid grid-cols-1 sm:grid-cols-7 md:grid-cols-7 gap-x-6 gap-y-10">
        {{--@foreach ($file as $item)
        <a href=""
            class="mt-2 flex flex-col bg-white drop-shadow hover:drop-shadow-lg hover:opacity-70 rounded-md">
            <img src="{{$item['banner']}}" alt="Fiction Product"
                class="h-30 object-contain rounded-tl-md rounded-tr-md">

            <div class="px-2 py-2">
                <h1 class="font-semibold">{{$item['title']}}</h1>
                <p class="text-sm">{{$item['year']}}</p>
                <p class="text-sm">{{$item->student->firstname}}</p>
            </div>
        </a>
        @endforeach--}}
    @foreach ($file as $item)
    @if($item->year <= 2020)
        <a href=""
            class="mt-2 flex flex-col bg-white drop-shadow hover:drop-shadow-lg hover:opacity-70 rounded-md">
            <img src="{{$item['banner']}}" alt="Fiction Product"
                class="h-30 object-contain rounded-tl-md rounded-tr-md">

            <div class="px-2 py-2">
                <h1 class="font-semibold">{{$item['title']}}</h1>
                <p class="text-sm">{{$item['year']}}</p>
                <p class="text-sm">{{$item->student->firstname}}</p>
            </div>
        </a>
 
   @else
       
   @endif
        @endforeach


    </div>
    </div>
</div>
@extends('partials.footer')



