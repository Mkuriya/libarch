@include('partials.adminnav')
<div class="h-[calc(100vh-5.5rem)]"> <!-- Adjusted height to account for the adminnav -->
    <div class="w-full flex justify-between items-center text-center">
        <p class="bg-whitebg w-full text-white px-8 py-2">Research Title: {{$file->title}}</p>
        <a href="/admin/dashboard/archive">
            <button class="bg-whitebg text-white px-4 py-2"> 
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="bg-gray-400 rounded-full text-black">
                    <path d="M18 6L6 18" />
                    <path d="M6 6L18 18" />
                </svg>
            </button>
        </a>
    </div>
    
    <div class="h-full bg-transparent flex flex-col justify-between items-center sm:px-4 relative">
        <div class="sm:w-1/2 w-full flex-1 overflow-y-auto relative">
            <iframe src="{{$file->document}}#toolbar=0" frameborder="0" class="w-full h-full bg-transparent border-whitebg border-8"></iframe>
        </div>
        <!-- Citation at the bottom of the iframe, fitting within the screen -->
        <p class="bg-whitebg sm:w-1/2 w-full text-white py-1 text-center">Citation: {{$file->citation}}</p>
    </div>
</div>
