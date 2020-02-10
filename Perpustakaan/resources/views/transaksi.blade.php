@extends('main')

@section('title', 'Transaksi')
@section('content')
        
        <div class="card" style="width: 35rem">
            <div class="card-body">
                <h5 class="card-title">Transaction</h5>
                <form>
                    <div class="row">
                        <div class="form-group col">
                                <label for="borrowed-date">Borrowed Date</label>
                                <input type="date" class="form-control" id="borrowed-date">
                        </div>
                        <div class="form-group col">
                            <label for="return-date">Return Date</label>
                            <input type="date" class="form-control" id="return-date" >
                    </div>
                    </div>
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword">
                      </div>
                    </div>
                  </form>
            </div>
    </div>
@endsection