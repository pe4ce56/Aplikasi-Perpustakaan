@extends('main')

@section('title', 'Transaction')
@section('content')

    <div class="card" style="width: 35rem">
        <div class="card-body">
            <h5 class="card-title">Transaction</h5>
            <form>
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
                <div class="form-group row">
                  <label for="staticEmail" class="col-sm-3 col-form-label">Customer's ID</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="customer-id" v-model="name"  v-on:keyup.13="enter">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-3 col-form-label">
                    Customer's Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="customer-name" v-bind:value="name">
                  </div>
                </div>
              </form>
        </div>
    </div>
@endsection