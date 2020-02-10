@extends('main')

@section('title', 'Students Data')
@section('content')
@if ($message = Session::get('status')) 
  <div class="alert alert-success alert-dismissible fade show" style="width: 30rem" role="alert">
    {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@endif
<div class="jumbotron">
<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">NIS</th>
        <th scope="col">Name</th>
        <th scope="col">Class</th>
        <th scope="col">Majors</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($students as $student)
        <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$student->NIS}}</td>
          <td>{{$student->nama}}</td>
          <td>{{$student->Class[0]['nama_kelas']}}</td>
          <td>{{$student->Majors[0]['nama_jurusan']}}</td>
          <td>
            <span class="badge badge-primary">Update</span>
            <form action="dataStudent/{{ $student->NIS }}" method="post" class="display-inline">
              @method('delete')
              @csrf
              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection