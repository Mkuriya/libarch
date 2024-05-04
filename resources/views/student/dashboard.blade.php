
<h1>Welcome 
    @if (auth()->guard('student')->check())
         <a href="{{url('/student/dashboard' . auth()->guard('student')->user()->id)}}" >  
            {{auth()->guard('student')->user()->firstname}}
        </a>
    @endif 
  
to Student Dashboard</h1>

<div class="card-body">
    <a href="{{url('/student/dashboard/logout')}}" class="btn btn-success btn-sm" >Logout</a>
</div>
