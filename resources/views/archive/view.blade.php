@include('partials.adminnav')

<div class="h-[88%]">
    
    <div class="w-full flex justify-center items-center text-center">
        <a href="/admin/dashboard/archive">
            <button class="bg-whitebg text-white  px-4 py-2  "> 
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 6L6 18" />
                    <path d="M6 6L18 18" />
                  </svg>
            </button>
        </a>
        <p class="bg-whitebg w-full text-white px-8 py-2">Research Title: {{$file->title}}</p>
        
    </div>
    <div class="h-full bg-transparent flex justify-center items-center px-4 relative">
        <div class="sm:w-1/2 w-full h-full overflow-y-auto absolute top-0 left-1/2 transform -translate-x-1/2">
            <iframe src="{{$file->document}}#toolbar=0" frameborder="0" class="w-full h-full bg-transparent border-whitebg border-8"></iframe>
        </div>
    </div>
        
</div>
  