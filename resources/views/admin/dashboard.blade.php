@extends('partials.header')

<div class="bg-gray-400">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>
    <h1>Welcome 
        @if (auth()->guard('admin')->check())
            <a href="{{url('/admin/dashboard/adminlist/' . auth()->guard('admin')->user()->id)}}" title="Edit Admin">  
                {{auth()->guard('admin')->user()->firstname}}
            </a>
        @endif 
    
    to Admin Dashboard</h1>
</div>
   




<div class="card-body">
    <a href="{{url('/admin/create')}}" class="btn btn-success btn-sm" >Add Admin</a>
</div><br>
<div class="card-body">
    <a href="{{url('/admin/student/create')}}" class="btn btn-success btn-sm" >Add Student</a>
</div><br>
<div class="card-body">
    <a href="{{url('/admin/dashboard/studentlist')}}" class="btn btn-success btn-sm" >View Student List</a>
</div><br>
<div class="card-body">
    <a href="{{url('/admin/dashboard/adminlist')}}" class="btn btn-success btn-sm" >View Admin List</a>
</div><br>
<div class="card-body">
    <a href="{{url('/admin/dashboard/adminlist')}}" class="btn btn-success btn-sm" >View Archive List</a>
</div><br>
<div class="card-body">
    <a href="{{url('/admin/dashboard/logout')}}" class="btn btn-success btn-sm" >Logout</a>
</div>


@extends('partials.footer')