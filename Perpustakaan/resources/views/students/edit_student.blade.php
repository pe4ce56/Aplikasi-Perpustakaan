@extends('layouts.app')

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Student</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted">Data</li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Students</li>
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
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    {{Form::open(['route' => ['students.update',$student->id],'method' => 'put','files' => true])}}
                   
                    {{-- @csrf --}}
                    <div class="row">
                        <div class="col-sm-6">
                            {{Form::bsText('NIS',old('NIS',$student->NIS))}}
                        </div>
                        <div class="col-sm-6">
                            {{Form::bsText('username',old('username',$user->username))}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{Form::bsText('name',old('name',$student->name))}}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {{Form::bsText('email',old('Email',$user->email))}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                {{Form::bsOption('gender',['Male' => 'Male','Female' => 'Female'],old('gender',$student->gender))}}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                {{Form::bsOption('religion',
                                ['Islam' => 'Islam','Kristem' => 'Kristem','Katholik' => 'Katholik','Hindu' => 'Hindu','Budha' => 'Budha','Konghu Chu' => 'Konghu Chu',]
                                ,old('religion',$student->religion))}}
                            </div>
                        </div>
                        <div class="col-sm-3">
                            {{Form::bsText('place_of_birth',old('place_of_birth',$student->place_of_birth))}}
                        </div>
                        <div class="col-sm-3">
                            {{Form::bsDate('date_of_birth',old('date_of_birth',$student->date_of_birth),'')}}
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-6">
                            {{Form::bsOption('grade',$grades,old('grade',$student->grade['id']))}}
                        </div>
                        <div class="col-sm-6">
                            {{Form::bsOption('department',$departments,old('department',$student->department['id']))}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            {{Form::bsText('phone_number',old('phone_number',$student->phone_number))}}
                        </div>
                        <div class="col-sm-6">
                            {{Form::bsFile('profile_picture','imgPreview')}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 ">
                            <div class="row">
                                <label class="col-sm-12" for="">Preview</label>
                                <img v-if="!image" 
                                src="{{old('',
                                $student->profile_picture ? asset('storage/profile_picture/'.$student->profile_picture) : $student->getAvatar())}}"
                                 class="col-sm-12 img-fluid p-0" style="height: 204px; max-width: 204px">
                                <img  v-if="image" :src="image" class="col-sm-12 img-fluid p-0" style="height: 204px; max-width: 204px">
                            </div>
                        </div>
                        <div class="col-sm-6 order-sm-last order-md-first">
                            <div class="form-group">
                               {{Form::bsTextarea('address',old('address',$student->address))}}
                            </div> 
                        </div>
                    </div>
                 <div class="form-actions">
                    <div class="text-right">
                        <button type="submit" class="btn btn-info">Submit</button>
                        <button type="reset" class="btn btn-dark">Reset</button>
                    </div>
                </div>
                {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End container fluid  -->
<!-- ============================================================== -->

@endsection

@section('footer')
<script>
     new Vue({
        el: '#app',
        data(){
            return {
                image: ''
            }
        },
        methods:{
            imgPreview(event){
                let input = event.target;
                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        this.image = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
                console.log(this.image);
            }
        }
    });
</script>
@endsection