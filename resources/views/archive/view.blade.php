@include('partials.adminnav')
<div class="bg-whitebg  ">
    <a href="/admin/dashboard/archive">
        <button>Back</button>
    </a>
</div>
    <br> 
    <div class="h-[88vh] bg-transparent flex justify-center items-center px-4">
        <iframe src="{{$file->document}}#toolbar=0" frameborder="0" class="w-full h-full bg-transparent"></iframe>
    </div>
    