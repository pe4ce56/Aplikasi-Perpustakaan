@extends('layouts.app')

@section('content')
    
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    {{-- {{dd($operator->name)}} --}}
    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-sm-7">
                <div class="card bg-success p-0 py-2 pb-3 rounded-0">
                        <div class="d-flex flex-column">
                            <img src="{{$operator->getAvatar()}}" class="img-fluid rounded-circle mx-auto" style="width:100px; heigth: 100px" alt="">
                            <div class="text-center text-white">
                                {{$operator->name}}
                            </div>
                        </div>
                    </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Profile</div>
                        <div class="row">
                            <div class="col-6">Name</div>
                            <div class="col-6 text-right">{{$operator->name}}</div>
                            <div class="col-6">Gender</div>
                            <div class="col-6 text-right">{{$operator->gender}}</div>
                            <div class="col-6">Religion</div>
                            <div class="col-6 text-right">{{$operator->religion}}</div>
                            <div class="col-6">Place of Birth</div>
                            <div class="col-6 text-right">{{$operator->place_of_birth}}</div>
                            <div class="col-6">Date of Birth</div>
                            <div class="col-6 text-right">{{$operator->date_of_birth}}</div>
                            <div class="col-6">Address</div>
                            <div class="col-6 text-right">{{isset($operator->address) ? $operator->address : '-' }}</div>
                            @if (auth()->user()->role == 'admin')
                                <div class="col-12 d-flex justify-content-center mt-4">
                                <a class="btn btn-warning text-white" href="/operators/{{$operator->id}}/edit">Edit Profile</a>
                                </div>    
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
@endsection