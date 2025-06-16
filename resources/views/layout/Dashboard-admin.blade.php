<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Dashboard</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet" />
  <style>
    .sidebar .nav .active {
    background-color:#2ca086; 
    color: white;
}


.sidebar .nav li:not(.active) a {
    color: #2ca086; 
}
.sidebar .nav li a {
    display: flex;
    align-items: center;
    color: #2ca086;
    padding: 10px;
    gap: 10px;
}

.sidebar .nav li.active a {
    background-color: #2ca086;
    color: #FFFFFF !important;
}

.sidebar .nav li a:hover {
    color: #FFFFFF;
    background-color:rgb(18, 77, 64);
}

.nav-icon {
    width: 20px;
    height: 20px;
}
.sidebar .nav li a img {

    filter: brightness(0) saturate(100%) invert(54%) sepia(31%) saturate(1002%) hue-rotate(111deg) brightness(92%) contrast(91%);
    transition: filter 0.3s ease;
}

.sidebar .nav li a:hover img,
.sidebar .nav li.active a img {
    filter: brightness(0) invert(1);
}


    </style>
</head>
<body>
  <div class="wrapper">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="#" class="simple-text logo-normal">
          Dashboard TIU
        </a>
      </div>
      <div class="sidebar-wrapper">
       <ul class="nav">
  <li class="{{ Request::is('test') ? 'active' : '' }}">
    <a href="{{ route('admin.results') }}" class="d-flex align-items-center">
        <img src="{{ asset('icon/test.svg') }}" alt="Icon Halaman Tes TIU" class="nav-icon me-2">
        <span class="fw-bold">Hasil User</span>
    </a>
</li>
    <li>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="d-flex align-items-center">
        <img src="{{ asset('icon/logout.svg') }}" alt="Logout Icon" class="nav-icon me-2">
        <span class="fw-bold">Logout</span>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li>
</ul>
      </div>
    </div>

    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="#">Dashboard TIU</a>
          </div>
        </div>
      </nav>

      <div class="content">
        @yield('content') 
      </div>

     
    </div>
  </div>
  
  <script src="{{ asset('js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
</body>
</html>