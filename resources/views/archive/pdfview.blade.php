@include('partials.studentnav')  
<div class="h-[88%]">
    <div class="w-full flex justify-center items-center text-center">
        <p class="bg-whitebg w-full text-white px-8 py-2">Research Title: {{$file->title}}</p>
    </div>
    <div class="h-full bg-transparent flex justify-center items-center px-4 relative">
        <div class="sm:w-1/2 w-full h-full overflow-y-auto absolute top-0 left-1/2 transform -translate-x-1/2">
            <iframe src="{{$file->document}}#toolbar=0" frameborder="0" class="w-full h-full bg-transparent border-whitebg border-8"></iframe>
        </div>
    </div>
</div>
