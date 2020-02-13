@extends('main')

@section('title', 'Transaction')
@section('content')
<h4 class="mt-3">Transaction</h4>
<div class="row">
  <div class="col-lg-4">
    <div class="card ml-3 mt-2">
      <div class="card-body">
        <h5>Customer</h5>
          <div class="form-group">
            <label >Customer's ID</label>
            <input type="text" class="form-control" id="customer-id" v-model="customerNIS"  v-on:keyup="searchingCustomer" v-on:keydown.enter.prevent="enteredDataCustomer" v-on:blur="searchedCustomer = true" v-on:focus="searchedCustomer = false">
            <div v-if="searchedCustomer == false">
              <ul class="list-group data">
                <div v-for="data in getCustomers">
                  <li class="list-group-item">@{{data.NIS}} - @{{data.nama}}</li>
                </div>
              </ul>
            </div>
          </div>

          <div class="form-group">
            <label for="nameCustomer">Customer's Name</label>
              <input type="text" class="form-control" ref="customerName" v-model="customerName">
          </div>
      </div>
    </div>
    <div class="card ml-3 mt-2">
      <div class="card-body">
        <h5>Data Book</h5>
          <div class="form-group">
            <label for="id-book">Book's ID</label>
            <input type="text" class="form-control" id="id-book" v-model="bookID" v-on:keyup="searchingBook" v-on:blur="searchedBook = true" v-on:focus="searchedBook = false"  v-on:keydown.enter.prevent="enteredDataBook" ref="bookID">
            <div v-if="searchedBook == false">
              <ul class="list-group data">
              <div v-for="data in getBooks">
                <li class="list-group-item">@{{data.id_buku}} - @{{data.judul_buku}}</li>
              </div>
              </ul>
            </div>
          </div>
      </div>
    </div>
  </div>
  <div class="col-lg-8  ">
    <div class="card mt-2">
      <div class="card-body">
        <h5>New Transaction</h5>
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
        <table class="table table-striped">
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
                  <td>@{{data.judul_buku }}</td>
                  <td width="30%"><input class="form-control form-control-sm" type="number" name="" ref="numberOfBook"></td>
                  <td> <button v-on:click="newTransactions.splice(i,1)">Remove</button></td>
             </tr>
            </tbody>
          </div>
        </table>
        <form>
          <inputbooksid v-for="(data, i) in getNewTransactions" v-bind:bookid="data.id_buku"></inputs>
          <button type="submit" class="btn btn-primary">Proccess</button>
        </form>
        </div>
      </div>
  </div>
</div>
@endsection