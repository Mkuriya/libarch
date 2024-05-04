@extends('partials.header')

<div class="card m-3 mw-lg">
    <div class="card-header">admins Information</div>
    <div class="card-body">
        
            <label for="">Last Name</label><br>
            <input type="text" name="lastname" id="lastname" class="form-control" value="{{$admins->lastname}}"><br>
            <label for="">First Name</label><br>
            <input type="text" name="firstname" id="firstname" class="form-control" value="{{$admins->firstname}}"><br>
            <label for="">Middle Name</label><br>
            <input type="text" name="middlename" id="middlename" class="form-control" value="{{$admins->middlename}}"><br>
            <label for="">Gender</label><br>
            <input type="text" name="gender" id="gender" class="form-control" value="{{$admins->gender}}"><br>
            <label for="">Email</label><br>
            <input type="email" name="email" id="email" class="form-control" value="{{$admins->email}}"><br>
            <img src="{{$admins->photo}}" width= '100' height='100' class="rounded-full" />
            <br>
            <a href="/admin/dashboard/adminlist"><button class="btn btn-success" >Back</button></a>
        
    </div>
</div>
@extends('partials.header')
