<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Argon Dashboard - Free Dashboard for Bootstrap 4</title>
  <!-- Favicon -->
  <link rel="icon" href="{{asset('assets/admin/img/brand/favicon.png')}}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{asset('/assets/admin/vendor/nucleo/css/nucleo.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('/assets/admin/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}"
      type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{asset('/assets/admin/css/argon.css?v=1.2.0')}}" type="text/css">

  @yield('css')
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="../assets/admin/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="{{route('home')}}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('category.index')}}">
                <i class="ni ni-archive-2 text-orange"></i>
                <span class="nav-link-text">Category</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('color.index')}}">
                <i class="ni ni-palette text-primary"></i>
                <span class="nav-link-text">Color</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('size.index')}}">
                <i class="ni ni-tag text-yellow"></i>
                <span class="nav-link-text">Size</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('product.index')}}">
                <i class="ni ni-bullet-list-67 text-default"></i>
                <span class="nav-link-text">Product</span>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('adminshoworder')}}">
                  <i class="ni ni-delivery-fast text-red"></i>
                  <span class="nav-link-text">Order List</span>
                </a>
              </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('coupon.index')}}">
                  <i class="ni ni-credit-card text-green"></i>
                  <span class="nav-link-text">Coupon</span>
                </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('welcome')}}">
                <i class="ni ni-shop text-pink"></i>
                <span class="nav-link-text">Shop</span>
              </a>
            </li>


          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->

        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->

          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>

          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">

                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold">{{auth()->user()->name}}</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="{{route('home')}}" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                <div class="dropdown-divider"></div>
                <a href="{{route('logout')}}" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->

    <!-- Page content -->
    <div class="container-fluid mt-3 ">

      @yield('content')
      @if(session()->has('success'))
      <div class="alert alert-success">{{session()->get('success')}}</div>
      @endif
      @if(session()->has('danger'))
      <div class="alert alert-danger">{{session()->get('danger')}}</div>
      @endif
      @if($errors->any())
      @foreach ($errors->all() as $e )
      <div class="alert alert-danger">{{$e}}</div>
      @endforeach
      @endif
      <!-- Footer -->

  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
    <script src="{{asset('assets/admin/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/admin/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/assets/admin/vendor/js-cookie/js.cookie.js')}}"></script>
    <script src="{{asset('assets/admin/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{asset('/assets/admin/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
    <!-- Optional JS -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
    <!-- Argon JS -->
    <script src="{{asset('/assets/admin/js/argon.js?v=1.2.0')}}"></script>
    @yield('script')
</body>

</html>
