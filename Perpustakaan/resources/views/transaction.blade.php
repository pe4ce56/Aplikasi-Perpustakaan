@extends('layouts.app')

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
  <div class="row">
      <div class="col-7 align-self-center">
          <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Form Inputs</h4>
          <div class="d-flex align-items-center">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb m-0 p-0">
                      <li class="breadcrumb-item text-muted">Data Student</li>
                      <li class="breadcrumb-item text-muted active" aria-current="page">Add Students</li>
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
  @if ($message = Session::get('status')) 
    <div class="alert alert-success alert-dismissible fade show" style="width: 30rem" role="alert">
      Transaction <strong>{{$message}}</strong> Saved
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
  <div class="row">
    <div class="col-lg-4">
      <div class="card ml-3 mt-2">
        <div class="card-body">
            <div class="form-group">
              <label >Customer's ID</label>
              <input type="text" class="form-control"  id="customerID" v-model="customerNIS"  v-on:keyup="searchingCustomer" v-on:keydown.enter.prevent="enteredDataCustomer" v-on:blur="searchedCustomer = true" v-on:focus="searchedCustomer = false">
          
              <ul v-if="searchedCustomer == false" class="list-group data">
                  <li v-for="data in getCustomers" class="list-group-item">@{{data.NIS}} - @{{data.nama}}</li>
              </ul>
            </div>
            
            <div class="form-group">
              <label for="nameCustomer">Customer's Name</label>
                <input type="text" class="form-control" ref="customerName" v-model="customerName">
            </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card ml-3 mt-2">
        <div class="card-body">
            <div class="form-group">
              <label for="id-book">Book's ID</label>
              <input type="text" class="form-control" id="id-book" v-model="bookID" v-on:keyup="searchingBook" v-on:blur="searchedBook = true" v-on:focus="searchedBook = false"  v-on:keydown.enter.prevent="enteredDataBook" ref="bookID">
              <ul v-if="searchedBook == false" class="list-group data">
                  <li v-for="data in getBooks" class="list-group-item">@{{data.id_buku}} - @{{data.judul_buku}}</li>
              </ul>
            </div>
        </div>
      </div>
    </div>
      
    <div class="col-lg-12">
      <div class="card mt-2">
        <div class="card-body">
          <div class="card-title">New Transaction</div>
          <div class="row">
            <div class="form-group col">
              <label for="borrowed-date">Borrowed Date</label>
              <input type="date" class="form-control" id="borrowed-date" v-bind:value="borrowedDate">
            </div>
            <div class="form-group col">
              <label for="return-date">Return Date</label>
              <input type="date" class="form-control" id="return-date" v-bind:value="returnedDate">
            </div>
          </div>
          <table class="table table-striped table-sm">
            <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Book's Title</th>
                  <th scope="col">number of books</th>
                  <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
              <div v-if="getNewTransactions">
                <tr v-for="(data, i) in getNewTransactions">
                    <th scope="row">@{{i+1}}</th> 
                    <td>@{{data.id_buku}} - @{{data.judul_buku }}</td>
                    <td width="20%"><input class="form-control form-control-sm" type="number" v-model="amountOfBooks[i]" ref="numberOfBook"></td>
                    <td class="text-center">
                      <button v-on:click="newTransactions.splice(i,1)" class="btn btn-danger btn-sm ">
                      <i class="far fa-trash-alt"></i>
                      </button>
                    </td>
              </tr>
              </tbody>
            </div>
          </table>
          <form method="post" action="/transaction">
            @csrf
            <input type="hidden" name="operatorID" value="2532">
            <input type="hidden" name="customerID" v-model="customerNIS">
            <input type="hidden" name="borrowedDate" v-model="borrowedDate">
            <input type="hidden" name="returnedDate" v-model="returnedDate">
            <div v-for="(data, i) in getNewTransactions">
              <input type="hidden" name="amountOfBooks[]" v-model="amountOfBooks[i]">
              <input type="hidden" name="bookid[]" v-model="data.id_buku">
            </div>
            <button type="submit" class="btn btn-primary">Proccess</button>
          </form>
          </div>
        </div>
    </div>
  </div>
@endsection

@section('footer')
  <script src="{{url('assets/js/App.js')}}"></script>
@endsection