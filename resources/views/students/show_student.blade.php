@extends('layouts.app')

@section('content')
    
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-sm-5">
                <div class="card bg-success p-0 py-2 rounded-0">
                        <div class="d-flex flex-column">
                            <img src="{{$student->getAvatar()}}" class="img-fluid rounded-circle mx-auto" style="width:100px; heigth: 100px" alt="">
                            <div class="text-center text-white">
                                {{$student->name}}
                            </div>
                        </div>
                    {{-- </div> --}}
                </div>
                <div class="card-group p-0" style="margin-top:-15px">
                    <div class="card bg-primary rounded-0 mt-n3">
                       <div class="card-body text-white text-center">
                            3 <br> Transaction
                        </div>
                    </div>
                    <div class="card bg-primary rounded-0 mt-n3">
                        <div class="card-body text-white text-center">
                            3 <br> Dependent
                        </div>
                    </div>
                    <div class="card bg-primary rounded-0 mt-n3" >
                        <div class="card-body text-white text-center">
                            3 <br> Penalty
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Profile</div>
                        <div class="row">
                            <div class="col-6">NIS</div>
                            <div class="col-6 text-right">{{$student->NIS}}</div>
                            <div class="col-6">Name</div>
                            <div class="col-6 text-right">{{$student->name}}</div>
                            <div class="col-6">Gender</div>
                            <div class="col-6 text-right">{{$student->gender}}</div>
                            <div class="col-6">Religion</div>
                            <div class="col-6 text-right">{{$student->religion}}</div>
                            <div class="col-6">Place of Birth</div>
                            <div class="col-6 text-right">{{$student->place_of_birth}}</div>
                            <div class="col-6">Date of Birth</div>
                            <div class="col-6 text-right">{{$student->date_of_birth}}</div>
                            <div class="col-6">Class</div>
                            <div class="col-6 text-right">{{$student->grade->name .' ' . $student->department->name}}</div>
                            <div class="col-6">Address</div>
                            <div class="col-6 text-right">{{isset($student->address) ? $student->address : '-' }}</div>
                            
                            @if (auth()->user()->role == 'admin')
                            <div class="col-12 d-flex justify-content-center mt-4">
                                <a class="btn btn-warning text-white" href="/students/{{$student->id}}/edit">Edit Profile</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
@endsection