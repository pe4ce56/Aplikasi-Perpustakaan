<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{url('css/app.css')}}">
  <link rel="stylesheet" href="{{url('css/style.css')}}">
    <title>@yield('title')</title>
  </head>
  <body>
    <div id="app">
      <div v-if="loading">
        <div class="container-fluid">
          <div class="d-flex justify-content-center">
            <div class="spinner-border text-primary loading" role="status">
              <span class="sr-only">Loading...</span>
            </div>
        </div>
      </div>
     </div>
    <div v-else>
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <a class="navbar-brand" href="#">Library application </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item ">
            <a class="nav-link" href="{{url("/dataStudent")}}">Data Students</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url("/transaction")}}">Transaction</a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="container-fluid">
        @yield('content')  
      </div>
      
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{url('js/app.js')}}"></script>
  </body>
</html> 