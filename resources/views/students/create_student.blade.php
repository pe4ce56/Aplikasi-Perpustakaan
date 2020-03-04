@extends('layouts.app')

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Add Student</h4>
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
                    {{Form::open(array('url' => 'students','files' => true))}}
                        <div class="row">
                            <div class="col-sm-6">
                                {{Form::bsText('NIS',old('NIS'))}}
                            </div>
                            <div class="col-sm-6">
                                {{Form::bsText('username',old('username'))}}
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{Form::bsText('name',old('name'))}}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{Form::bsText('email',old('Email'))}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                {{Form::bsOption('gender',['Male' => 'Male','Female' => 'Female'],old('gender'))}}
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    {{Form::bsOption('religion',
                                    ['Islam' => 'Islam','Kristen' => 'Kristen','Katholik' => 'Katholik','Hindu' => 'Hindu','Budha' => 'Budha','Konghu Chu' => 'Konghu Chu',]
                                    ,old('religion'))}}
                                </div>
                            </div>
                            <div class="col-sm-3">
                                {{Form::bsText('place_of_birth',old('place_of_birth'))}}
                            </div>
                            <div class="col-sm-3">
                                {{Form::bsDate('date_of_birth',old('date_of_birth'),'id')}}
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {{Form::bsOption('grade',$grades,old('grades'))}}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                {{Form::bsOption('department',$departments,old('department'))}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                {{Form::bsText('phone_number',old('phone_number'),'Phone Number')}}
                            </div>
                            <div class="col-sm-6">
                                {{Form::bsFile('profile_picture','imgPreview')}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row"  v-if="image">
                                    <label class="col-sm-12" for="">Image Preview</label>
                                    <img :src="image" class="col-sm-12 img-fluid p-0" style="height: 204px; max-width: 204px">
                                </div>
                            </div>
                            <div class="col-sm-6 order-sm-last order-md-first">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="Adrress" rows="8" style="resize:none" placeholder="Adrress......." name="address"></textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div> 
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="text-right">
                                <button type="submit" class="btn btn-info">Submit</button>
                                <button type="reset" @click="reset" class="btn btn-dark">Reset</button>
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
            reset(){
                this.image='';
            }
        }
    });
</script>
@endsection