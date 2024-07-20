@include('partials.studentnav')
<div class="absolute max-w-2xl ">
	<aside class="w-64 ml-4" aria-label="Sidebar">
		<div class="px-3 py-4 overflow-y-auto rounded bg-gray-50 dark:bg-whitebg text-white">
			<ul class="space-y-2">
				<li class="hover:text-amber-500">
					<a href="/student/dashboard/archivelist">
                        <button>Back</button>
                    </a>
				</li>
				<li>
                    <p>Book Information</p>
                    <br>
                    <label for="">Title</label>
                    <p>{{$file->title}}</p>
					
				</li>
				
			</ul>
		</div>
	</aside>
</div>  
  
<div class="h-[90vh] w-full bg-transparent flex justify-center items-center px-4">
    <iframe src="{{$file->document}}#toolbar=0" frameborder="0" class="w-[50%] h-full bg-transparent"></iframe>
</div>
{{--}}
<div>
    
   
        <div class="px-4 ml-2 mt-2  inline-flex overflow-hidden bg-white border divide-x rounded-lg dark:bg-whitebg rtl:flex-row-reverse dark:border-gray-700 dark:divide-gray-700">
            <a href="/student/dashboard/archivelist" class="inline-block rounded py-1.5 px-3  text-white ">Back</p></a>
        </div>

    </div>
    <br> 
    
</div>--}}