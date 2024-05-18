@include('partials.adminnav')
<div class="bg-[rgba(0,0,0,0.5)]">

<div class=" text-xl text-white">
    <p class="text-center mt-10 text-xl">Welcome
    {{auth()->guard('admin')->user()->firstname}}
        to Dashboard
</p>
</div>


</div>
@extends('partials.footer')
