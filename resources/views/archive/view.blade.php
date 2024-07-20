@include('partials.adminnav')

    <div class=" mt-2">
        <div class=" flex justify-center items-center px-4"> 
            <p class="bg-whitebg text-white hover:bg-gray-400 hover:text-black px-8  mt-1">Research Title: {{$file->title}}</p>
        </div>
        <div class="h-[86vh]  bg-transparent flex justify-center  items-center px-4">
            <iframe src="{{$file->document}}#toolbar=0" frameborder="0" class="w-1/2 h-full bg-transparent border-whitebg border-4"></iframe>
        </div>
    <div class=" flex justify-center items-center px-4"> 
        <a href="/admin/dashboard/archive">
            <button class="bg-whitebg text-white hover:bg-gray-400 hover:text-black px-8  "> Back</button>
        </a>
    </div>
</div>