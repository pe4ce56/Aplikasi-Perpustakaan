@extends('layouts.app')

@section('content')
@if ($message = Session::get('status')) 
  <div class="alert alert-success alert-dismissible fade show" style="width: 30rem" role="alert">
    {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@endif
<div class="card">
  <div class="card-body">
    <div class="table-responsive">
    <table class="table table-hover" id="test">
        <thead class="bg-primary text-white">
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
              <td class="d-flex ">
                <a class="btn btn-sm btn-success text-white"><i class="far fa-edit"></i></a>
                <form action="dataStudent/{{ $student->NIS }}" method="post" class="display-inline">
                  @method('delete')
                  @csrf
                  <button type="submit" class="btn btn-sm btn-danger"> <i class="far fa-trash-alt"></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    </div>
</div>

@endsection

@section('header')
<link href="{{url('vendor/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">    
@endsection

@section('footer')
  <script src="{{url('vendor/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script>
  $(document).ready( function () {
      $('#test').DataTable();
  } );
  </script>
@endsection