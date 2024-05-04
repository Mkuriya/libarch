@extends('student.layout')

@section('content')
<div class="card m-3 mw-lg">
    <div class="card-header">Students Information</div>
    <div class="card-body">
        
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
            <img src="{{$students->photo}}" width= '100' height='100' class="img img-responsive" />
            <br>
            <a href="/admin/dashboard/studentlist"><button class="btn btn-success" >Back</button></a>
        
    </div>
</div>
@endsection