@include('partials.studentnav')
<div class="bg-[rgba(0,0,0,0.5)]">

    <div class=" text-xl text-white">
        <p class="text-center mt-10 text-xl">Welcome
            {{auth()->guard('student')->user()->firstname}}
        Dashboard
        </p>
    </div>
    
    
    </div>
    @extends('partials.footer')
    