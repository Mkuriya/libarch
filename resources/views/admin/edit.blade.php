@extends('student.layout')

@section('content')
<div class="card m-3">
    <div class="card-header">Edit admins</div>
    <div class="card-body">
        <form action="{{url('admin/dashboard/adminlist/' .$admins->id )}}" method="post">
            {!! csrf_field() !!}
            @method('PATCH')
            <input type="hidden" name="id" id="id" class="form-control" value="{{$admins->id}}"><br>
            <label for="">Last Name</label><br>
            <input type="text" name="lastname" id="lastname" class="form-control" value="{{$admins->lastname}}"><br>
            <label for="">First Name</label><br>
            <input type="text" name="firstname" id="firstname" class="form-control" value="{{$admins->firstname}}"><br>
            <label for="">Middle Name</label><br>
            <input type="text" name="middlename" id="middlename" class="form-control" value="{{$admins->middlename}}"><br>
            <label for="">Gender</label><br>
            <input type="text" name="gender" id="gender" class="form-control" value="{{$admins->gender}}"><br>
            <label for="">Department</label><br>
            <input type="text" name="department" id="department" class="form-control" value="{{$admins->department}}"><br>
            <label for="">Email</label><br>
            <input type="email" name="email" id="email" class="form-control" value="{{$admins->email}}"><br>
            <a href="/admin/dashboard/adminlist"><button class="btn btn-success" >Back</button></a>
            <button class="btn btn-success" type="submit" >Update</button>
        </form>
    </div>
</div>
@endsection