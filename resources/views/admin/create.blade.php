@extends('student.layout')

@section('content')
<div class="card m-3">
    <div class="card-header">Create New Admin</div>
    <a href="{{url('/admin/dashboard')}}" class="btn btn-success btn-sm" title="add new student">Dashboard</a>
    <div class="card-body">
        <form action="{{url('admin')}}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <label for="">Last Name</label><br>
            <input type="text" name="lastname" id="lastname" class="form-control"><br>
            <label for="">First Name</label><br>
            <input type="text" name="firstname" id="firstname" class="form-control"><br>
            <label for="">Middle Name</label><br>
            <input type="text" name="middlename" id="middlename" class="form-control"><br>
            <label for="">Gender</label><br>
            <select name="gender" id="gender" class="form-control">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>
            <label for="">Email</label><br>
            <input type="email" name="email" id="email" class="form-control"><br>
            <label for="">Password</label><br>
            <input type="password" name="password" id="password" class="form-control"><br>
            <label for="">Re-type Password</label><br>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"><br>

            <label for="photo">Photo</label>
            <input class="form-control" name="photo" type="file" id="photo">
            <button class="btn btn-success" type="submit" >Save</button>
        </form>
    </div>
</div>
@endsection