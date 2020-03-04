@extends('layouts.app')

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Books</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted">Data</li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Books</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->

<div class="container-fluid" id="app">
    @include('sweet::alert')
    <!-- ============================================================== -->
    <!-- Card Data  -->
    <!-- ============================================================== -->
    <div class="card">
        <div class="card-header">
            <a href="{{url('books/create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Book</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="table-books">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col" style="width: 7%">No</th>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Publisher</th>
                        <th scope="col">Author</th>
                        <th scope="col" style="width: 10%">Image</th>
                        <th scope="col" style="width: 8%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$book->code}}</td>
                        <td>{{$book->title}}</td>
                        <td>{{$book->publisher}}</td>
                        <td>{{$book->author}}</td>
                        <td>
                            <img src="{{asset('storage/book_images/'. $book->image)}}" alt="" style="max-heigth: 110px; max-width: 70px">
                        </td>
                        <td class="d-flex justify-content-center">
                        <a class="btn btn-sm btn-success text-white" href="/books/{{$book->id}}/edit"><i class="far fa-edit"></i></a>
                        {{Form::open(['route'=>['books.destroy',$book->id], 'method'=>'delete', 'id' => 'form-delete'])}}
                            <button type="button" class="btn btn-sm btn-danger" id="delete"> <i class="far fa-trash-alt"></i></button>
                        {{Form::close()}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Card Data  -->
    <!-- ============================================================== -->
</div>
@endsection


@section('header')
<link href="{{url('vendor/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">    
@endsection

@section('footer')
  <script src="{{url('vendor/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script>
      $('#table-books').DataTable();
      $('#delete').click(function(){
        const form = $('#form-delete');
        Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                return form.submit();
                }
            })  
    });
  </script>
@endsection