@extends('student.layout')

@section('content')
<div class="card m-3">
    <div class="card-header">Edit Students</div>
    <div class="card-body">
        <form action="{{url('admin/dashboard/studentlist/' .$students->id )}}" method="post">
            {!! csrf_field() !!}
            @method('PATCH')
            <input type="hidden" name="id" id="id" class="form-control" value="{{$students->id}}"><br>
            <label for="">Last Name</label><br>
            <input type="text" name="lastname" id="lastname" class="form-control" value="{{$students->lastname}}"><br>
            <label for="">First Name</label><br>
            <input type="text" name="firstname" id="firstname" class="form-control" value="{{$students->firstname}}"><br>
            <label for="">Middle Name</label><br>
            <input type="text" name="middlename" id="middlename" class="form-control" value="{{$students->middlename}}"><br>
            <label for="">Gender</label><br>
            <input type="text" name="gender" id="gender" class="form-control" value="{{$students->gender}}"><br>
            <label for="">Department</label><br>
            <input type="text" name="department" id="department" class="form-control" value="{{$students->department}}"><br>
            <label for="">Email</label><br>
            <input type="email" name="email" id="email" class="form-control" value="{{$students->email}}"><br>
            
            <button class="btn btn-success" type="submit" >Update</button>
        </form>
    </div>
</div>
@endsection