@php
    use \App\Http\Controllers\TransactionController;
@endphp
@extends('layouts.app')

@section('content')
    <!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Borrowing Book</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted">Transaction</li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Borrowing Book</li>
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
        <div class="col-sm-5">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="NIS">NIS</label>
                        <input type="text" class="form-control" id="NIS" placeholder="NIS">
                      </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <button class="btn btn-primary btn-sm btn-block" @click="selectCustomer">Select</button>
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-secondary btn-sm btn-block"  id="clear-customer">Clear</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-5">
            <div class="card">
                <div class="card-body">
                    {{Form::bsText("book_code",'','book_code')}} 
                    <div class="row">
                        <div class="offset-md-4 offset-lg-4 col-md-9 col-lg-8 col-12 ">
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-primary btn-sm btn-block" @click="addBook">Add</button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-secondary btn-sm btn-block"  id="clear-book">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            {{Form::bsDate("borrowing_date",TransactionController::getBorrowingDate(),"readonly")}}
                        </div>
                        <div class="col-sm-3">
                            {{Form::bsDate("date_of_return",TransactionController::getDateOfReturn(),"readonly")}}
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="NIS">NIS</label>
                                <input type="text" class="form-control" v-model="dataCustomer.NIS" readonly>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="NIS">Name</label>
                                <input type="text" class="form-control" v-model="dataCustomer.name" readonly >
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-primary table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col" style="width: 10%">No</th>
                                    <th scope="col">Book</th>
                                    <th scope="col">Book Image</th>
                                    <th scope="col" style="width: 5%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(data,i) in newTransaction"> 
                                    <td>@{{i+1}}</td>
                                    <td class="d-flex">
                                        <div class="text">
                                            @{{data.code + ' - ' + data.title}}
                                        </div> 
                                        
                                    </td>
                                    <td><img :src="data.image" class="ml-2" style="height: 65px" alt=""></td>
                                    <td>
                                        <button @click="newTransaction.splice(i,1)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>  
                    <div class="d-flex">
                        <form action="/transaction" method="POST">
                            @csrf
                            <input type="hidden" name="student_id" v-model="dataCustomer.id">
                            <div v-for="data in newTransaction">
                                <input type="hidden" name="book_id[]" v-model="data.id">
                            </div>
                            <button type="button" class="btn btn-secondary mr-1" @click="clearAll">Clear</button>
                            <button class="btn btn-primary" :disabled="!newTransaction.length || !dataCustomer">Process</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('header')

<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
    .list-item-container {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: flex-end;
    }
    .list-item-container .image img{
        height: 30px;
    }
</style>
@endsection
@section('footer')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('js/transaction.js')}}"></script>
@endsection