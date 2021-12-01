<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>E-Commerence by Tun Thiha</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/landing/img/favicon.ico">

    <!-- CSS here -->
        <link rel="stylesheet" href="{{asset('/assets/landing/css/bootstrap.min.css')}}">

        <link rel="stylesheet" href="{{asset('/assets/landing/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/landing/css/flaticon.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/landing/css/slicknav.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/landing/css/animate.min.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/landing/css/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/landing/css/fontawesome-all.min.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/landing/css/themify-icons.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/landing/css/slick.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/landing/css/nice-select.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/landing/css/style.css')}}">
        <script src="https://kit.fontawesome.com/4e0c375639.js" crossorigin="anonymous"></script>
        @yield('css')
</head>

<body>
    <!--? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="menu-wrapper">
                        <!-- Logo -->

                        <!-- Main-menu -->
                        <div class="main-menu d-none d-lg-block text-center">
                            <nav>
                                <ul id="navigation">
                                    <li><a href="{{route('welcome')}}">Home</a></li>

                                    <li><a href="about.html">about</a></li>
                                    <li><a href="#">Category</a>
                                        <ul class="submenu">
                                            @foreach ($category as $c)
                                            <li>
                                            <a href="{{route('categoryfilter',['id'=>$c->id])}}">{{$c->name}}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @auth
                                    <li><a href="{{route('cart')}}">Cart</a></li>
                                    <li><a href="{{route('showorder')}}">Order</a></li>
                                    @endauth

                                </ul>
                            </nav>
                        </div>
                        <!-- Header Right -->
                        <div class="header-right">

                            <ul>
                                <li>
                                    <form action="{{route('search')}}"  class="form-inline" method="GET">
                                        <input class="form-control mr-sm-2 medium" type="search" placeholder="Search" name="search"
                                            aria-label="Search" value="{{request()->search ? request()->search : ''}}">

                                        <button class="genric-btn primary-border medium" type="submit">Search</button>
                                    </form>
                                </li>
                                @guest
                                <li> <a href="{{route('login')}}"><span><i class="fas fa-sign-in-alt fa-2x pt-1"></i></span></a></li>
                                <li> <a href="{{route('register')}}"><span><i class="fas fa-user-plus fa-2x pt-1"></i></span></a></li>
                                @endguest
                                @auth
                                <li><a href="{{route('logout')}}"><span><i class="fas fa-sign-out-alt fa-2x pt-1"></i></span></a> </li>
                                @endauth

                            </ul>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>
        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Ecommence by Tun Thiha</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End-->
       <div class="container">
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
        @yield('content')


       </div>
    </main>
    <footer>
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <!-- logo -->
                                <div class="footer-logo">
                                    <a href="index.html"><img src="assets/img/logo/logo2_footer.png" alt=""></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p>This ecommerce site is created solely by Tun Thiha</p>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Category</h4>
                                <ul>
                                    @for ($i = 0; $i <= 3; $i++)
                                    <li>
                                        <a href="{{route('categoryfilter',['id'=>$category[$i]->id])}}">{{$category[$i]->name}}</a>
                                    </li>
                                    @endfor

                                    {{-- @foreach ($category as $c)
                                            <li>
                                            <a href="{{route('categoryfilter',['id'=>$c->id])}}">{{$c->name}}</a>
                                            </li>

                                    @endforeach --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>New Products</h4>
                                <ul>
                                    @foreach ($productlist as $p)
                                    <li>
                                        <a href="{{route('productdetail',$p->id)}}">{{$p->name}}</a>
                                    </li>
                                    @endforeach


                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Support</h4>
                                <ul>
                                    <li><a href="#">Frequently Asked Questions</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Report a issue</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer bottom -->
                <div class="row align-items-center">
                    <div class="col-xl-7 col-lg-8 col-md-7">
                        <div class="footer-copy-right">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-4 col-md-5">
                        <div class="footer-copy-right f-right">
                            <!-- social -->
                            <div class="footer-social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                                <a href="#"><i class="fas fa-globe"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>
    <!--? Search model Begin -->
    <div class="search-model-box">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-btn">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Searching key.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

<!-- JS here -->
    <!-- All JS Custom Plugins Link Here here -->
    <script src="{{asset('/assets/landing/js/vendor/modernizr-3.5.0.min.js')}}"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{asset('/assets/landing/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('/assets/landing/js/popper.min.js')}}"></script>
    <script src="{{asset('/assets/landing/js/bootstrap.min.js')}}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{asset('/assets/landing/js/jquery.slicknav.min.js')}}"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{asset('/assets/landing/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('/assets/landing/js/slick.min.js')}}"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="{{asset('/assets/landing/js/wow.min.js')}}"></script>
    <script src="{{asset('/assets/landing/js/animated.headline.js')}}"></script>
    <script src="{{asset('/assets/landing/js/jquery.magnific-popup.js')}}"></script>

    <!-- Scroll up, nice-select, sticky -->
    <script src="{{asset('/assets/landing/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('/assets/landing/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('/assets/landing/js/jquery.sticky.js')}}"></script>

    <!-- contact js -->
    <script src="{{asset('/assets/landing/js/contact.js')}}"></script>
    <script src="{{asset('/assets/landing/js/jquery.form.js')}}"></script>
    <script src="{{asset('/assets/landing/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('/assets/landing/js/mail-script.js')}}"></script>
    <script src="{{asset('/assets/landing/js/jquery.ajaxchimp.min.js')}}"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="{{asset('/assets/landing/js/plugins.js')}}"></script>
    <script src="{{asset('/assets/landing/js/main.js')}}"></script>
    @yield('script')

</body>
</html>
