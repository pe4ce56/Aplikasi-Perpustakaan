@extends('main')

@section('title', 'Transaksi')
@section('content')
<div class="jumbotron">
<table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">NIS</th>
        <th scope="col">Name</th>
        <th scope="col">Class</th>
        <th scope="col">Majors</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($students as $student)
        <tr>
          <th scope="row"></th>
        <td>{{$student->NIS}}</td>
          <td>{{$student->nama}}</td>
          <td>{{$student->class[0]['nama_kelas']}}</td>
          <td>{{$student->jurusan}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection