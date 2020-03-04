@extends('layouts.app')
@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
@include('sweet::alert')
<div class="page-breadcrumb">
  <div class="row">
      <div class="col-7 align-self-center">
          <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Classes</h4>
          <div class="d-flex align-items-center">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb m-0 p-0">
                      <li class="breadcrumb-item text-muted">Data</li>
                      <li class="breadcrumb-item text-muted active" aria-current="page">Classes</li>
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
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Grade</div>
                    
                    <button class="btn btn-primary"  type="button"  data-toggle="modal" data-target="#add-grade"><i class="fas fa-plus"></i> Add</button>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col" style="width: 7%">No</th>
                                <th scope="col">Name</th>
                                <th scope="col" style="width:15%"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($grades as $grade)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$grade->name}}</td>
                                        <td class="d-flex">
                                            <button type="button"
                                            class="btn btn-sm btn-success text-white edit-grade" data-toggle="modal" 
                                            data-target="#edit-grade" data-id="{{$grade->id}}">
                                            <i class="far fa-edit"></i>
                                            </button>
                                            <form action="/class/{{ $grade->id }}" id="form-grade-delete-{{$grade->id}}" method="post" class="display-inline">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" name="__App" value="grade">
                                                <button type="button" class="btn btn-sm btn-danger delete-grade" data-id="{{$grade->id}}"><i class="far fa-trash-alt"></i></button>
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
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Departments</div>
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#add-department"><i class="fas fa-plus"></i> Add</button>
                    <div class="table-responsive mt-2">
                        <table class="table table-hover">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col" style="width: 7%">No</th>
                                <th scope="col">Name</th>
                                <th scope="col" style="width:15%"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $department)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$department->name}}</td>
                                        <td class="d-flex">
                                            <button type="button"
                                                class="btn btn-sm btn-success text-white edit-department" data-toggle="modal" 
                                                data-target="#edit-department" data-id="{{$department->id}}">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <form action="/class/{{ $department->id }}" id="form-department-delete-{{$department->id}}" method="post" class="display-inline">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" name="__App" value="department">
                                                <button type="button" class="btn btn-sm btn-danger delete-department" data-id="{{$department->id}}"><i class="far fa-trash-alt"></i></button>
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
</div>

{{-- Modal Grades--}}
<div class="modal fade" id="add-grade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Grades</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{Form::open(array('url' => '/class'))}}
          <input type="hidden" name="__App" value="grade">
          {{Form::bsText('name',old('name'))}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
          {{Form::close()}}
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="edit-grade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Grades</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="form-edit-grade">
                @method('PUT')
                @csrf
                <input type="hidden" name="__App" value="grade">
                {{Form::bsText('name',old('name'),'edit-grade-name')}}
            </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
      </div>
    </div>
  </div>

{{-- department --}}
<div class="modal fade" id="add-department" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{Form::open(array('url' => '/class'))}}
          <input type="hidden" name="__App" value="department">
          {{Form::bsText('name',old('name'))}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
          {{Form::close()}}
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="edit-department" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Grades</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="form-edit-department">
                @method('PUT')
                @csrf
                <input type="hidden" name="__App" value="department">
                {{Form::bsText('name',old('name'),'edit-department-name')}}
            </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('footer')
    <script>
        $('.edit-grade').click(function(){
        const id = $(this).data('id');
        fetch('{{url('class/getDataGrade')}}/' + id)
        .then((response) => response.json())
        .then((response) => {
            $('#form-edit-grade').attr('action','{{url('class')}}/'+id);
            $('#edit-grade-name').val(response.name);
        });
    })
        $('.delete-grade').click(function(){
        const id = $(this).data('id');
         const form = $('#form-grade-delete-'+id);
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

    $('.edit-department').click(function(){
        const id = $(this).data('id');
        fetch('{{url('class/getDataDepartment')}}/' + id)
        .then((response) => response.json())
        .then((response) => {
            $('#form-edit-department').attr('action','{{url('class')}}/'+id);
            $('#edit-department-name').val(response.name);
        });
    })

        $('.delete-department').click(function(){
            const id = $(this).data('id');
            const form = $('#form-department-delete-'+id);
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