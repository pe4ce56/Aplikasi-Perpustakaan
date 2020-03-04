@extends('layouts.app')

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Add Book</h4>
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
    <div class="card">
        <div class="card-body">
            {{Form::open(['route' => ['books.update',$book->id],'method'=>'put' ,'files' => true])}}
            <div class="row">
                <div class="col-sm-4">
                    {{Form::bsText('code',old('code',$book->code))}}
                </div>
                <div class="col-sm-8">
                    {{Form::bsText('title',old('title',$book->title))}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 ">
                    {{Form::bsText('publisher', old('publisher',$book->publisher))}}
                    {{Form::bsText('author', old('author',$book->author))}}
                    {{Form::bsFile('image','imgPreview')}}
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <label class="col-sm-12" for="image">Image Preview</label>
                        <img v-if="!image" src="{{old('',asset('storage/book_images/' . $book->image))}}" class="col-sm-12 img-fluid p-0" style="max-heigth: 220px; max-width: 140px">
                        <img v-if="image" :src="image" class="col-sm-12 img-fluid p-0"  style="max-heigth: 220px; max-width: 140px">
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
<!-- ============================================================== -->
<!-- End Container fluid  -->
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