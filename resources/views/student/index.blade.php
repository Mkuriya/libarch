@extends('student.layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Student Crud</h2>
                </div>
                <div class="card-body">
                    <a href="{{url('/admin/dashboard')}}" class="btn btn-success btn-sm" title="add new student">Dashboard</a>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Gender</th>
                                <th>Department</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student as $item)
                                <tr>
                                <td>{{$item->lastname}}</td>
                                <td>{{$item->firstname}}</td>
                                <td>{{$item->middlename}}</td>
                                <td>{{$item->gender}}</td>
                                <td>{{$item->department}}</td>
                                <td>{{$item->email}}</td>
                                <td><img src="{{ asset($item->photo) }}" width= '100' height='100' class="img img-responsive" /></td>
                                <td>
                                    <a href="{{ url('/admin/dashboard/studentlist/' . $item->id) }}" title="View Student"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                    <a href="{{ url('/admin/dashboard/studentlist/' . $item->id . '/edit') }}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
  
                                    <form method="POST" action="{{ url('/admin/dashboard/studentlist' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick="return confirm("Confirm delete?")"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection