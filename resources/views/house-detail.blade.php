<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />

    <meta name="description" content="" />

    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
          rel="stylesheet" />
    {{--    <!-- <link rel="shortcut icon" href="{{asset("/assets/images/roommate.png")}}" />--}}
    {{--    <link rel="shortcut icon" href="{{asset("/assets/images/roommate.png")}}" /> -->--}}
    <link rel="shortcut icon" href="{{asset('/assets/images/roommate.png')}}">

    <link rel="stylesheet" href="{{asset('/assetsHome/fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('/assetsHome/fonts/flaticon/font/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('/assetsHome/css/tiny-slider.css')}}">
    <link rel="stylesheet" href="{{asset('/assetsHome/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('/assetsHome/css/style.css')}}">


    <title>RoomMate - Home</title>
</head>

<body>
<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<nav class="site-nav">
    <div class="container" >
        <div class="menu-bg-wrap" >
            <div class="site-navigation">
                <a href="{{route('home.index')}}" class="logo m-0 float-start">
                    RoomMate
                </a>

                <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                    <li class="{{ Route::currentRouteName() == 'home.index' ? 'active' : '' }}">
                        <a href="{{ route('home.index') }}">Trang Chủ</a>
                    </li>
                    <li class="{{ Route::currentRouteName() == 'home.house' ? 'active' : '' }}">
                        <a href="{{route('home.house')}}">Cho Thuê</a>

                    </li>
                    <li class="{{ Route::currentRouteName() == 'home.contact' ? 'active' : '' }}">
                        <a href="{{route('home.contact')}}">Liên Hệ</a>
                    </li>
                    <li class="{{ Route::currentRouteName() == 'home.about' ? 'active' : '' }}">
                        <a href="{{route('home.about')}}">Giới Thiệu</a>
                    </li>
                </ul>
                <a href="#"
                   class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
                   data-toggle="collapse" data-target="#main-navbar">
                    <span></span>
                </a>
            </div>
        </div>
    </div>
</nav>

<div
    class="hero page-inner overlay"
    style="background-image: url('{{asset('/assetsHome/images/hero_bg_3.jpg')}}')"
>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up">
                    Chi Tiết Nhà Thuê
                </h1>

                <nav
                    aria-label="breadcrumb"
                    data-aos="fade-up"
                    data-aos-delay="200"
                >
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang Chủ</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{route('home.house')}}">Nhà Thuê</a>
                        </li>
                        <li
                            class="breadcrumb-item active text-white-50"
                            aria-current="page"
                        >
                            {{$house->name}}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row justify-content-between">
            <!-- Hiển thị hình ảnh -->
            <div class="col-lg-7">
                <div class="img-property-slide-wrap">
                    <div class="img-property-slide">
                        @forelse ($house->images as $image)
                            <img style="height: 700px !important" src="{{ asset($image->image_path) }}" alt="Image" class="img-fluid" />
                        @empty
                            <img src="{{ asset('/assetsHome/images/default.jpg') }}" alt="No Image" class="img-fluid" />
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Hiển thị thông tin căn nhà -->
            <div class="col-lg-4">
                <h2 class="heading text-primary">{{ $house->name }}</h2>
                <p class="meta">{{ $house->area_name }}, {{ $house->area_address }}</p>

                <p style="margin-top: -10px; white-space: pre-line;" class="d-block text-black-50 mb-2">{{ $house->description }}</p>

                <!-- Thông tin thêm -->
                <h3><strong>Giá Tiền:</strong> ${{ number_format($house->price, 0, '.', ',') }}</h3>


                <!-- Thông tin đại lý -->
                <div class="d-block agent-box p-5">
                    <div class="img mb-4">
                        <img
                            src="{{ $house->user_avatar ? $house->user_avatar : asset('/assetsHome/images/person_2-min.jpg') }}"
                            style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;"
                            alt="User Avatar"
                        />

                    </div>
                    <div class="text">
                        <h3 class="mb-0">{{$house->user_name}}</h3>
                        <div class="meta mb-3 mt-2">{{$house->user_note}}</div>
                        <p>
                           Liên hệ: {{$house->user_email}}
                        </p>
                        <p>
                            Số điện thoại: {{$house->user_phone}}
                        </p>
                        <ul class="list-unstyled social dark-hover d-flex">
                            <li class="me-1">
                                <a href="#"><span class="icon-instagram"></span></a>
                            </li>
                            <li class="me-1">
                                <a href="#"><span class="icon-twitter"></span></a>
                            </li>
                            <li class="me-1">
                                <a href="#"><span class="icon-facebook"></span></a>
                            </li>
                            <li class="me-1">
                                <a href="#"><span class="icon-linkedin"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="widget">
                    <h3>Contact</h3>
                    <address>43 Raymouth Rd. Baltemoer, London 3910</address>
                    <ul class="list-unstyled links">
                        <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
                        <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
                        <li>
                            <a href="mailto:info@mydomain.com">info@mydomain.com</a>
                        </li>
                    </ul>
                </div>
                <!-- /.widget -->
            </div>
            <!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <div class="widget">
                    <h3>Sources</h3>
                    <ul class="list-unstyled float-start links">
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Vision</a></li>
                        <li><a href="#">Mission</a></li>
                        <li><a href="#">Terms</a></li>
                        <li><a href="#">Privacy</a></li>
                    </ul>
                    <ul class="list-unstyled float-start links">
                        <li><a href="#">Partners</a></li>
                        <li><a href="#">Business</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Creative</a></li>
                    </ul>
                </div>
                <!-- /.widget -->
            </div>
            <!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <div class="widget">
                    <h3>Links</h3>
                    <ul class="list-unstyled links">
                        <li><a href="#">Our Vision</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Contact us</a></li>
                    </ul>

                    <ul class="list-unstyled social">
                        <li>
                            <a href="#"><span class="icon-instagram"></span></a>
                        </li>
                        <li>
                            <a href="#"><span class="icon-twitter"></span></a>
                        </li>
                        <li>
                            <a href="#"><span class="icon-facebook"></span></a>
                        </li>
                        <li>
                            <a href="#"><span class="icon-linkedin"></span></a>
                        </li>
                        <li>
                            <a href="#"><span class="icon-pinterest"></span></a>
                        </li>
                        <li>
                            <a href="#"><span class="icon-dribbble"></span></a>
                        </li>
                    </ul>
                </div>
                <!-- /.widget -->
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->

        <div class="row mt-5">
            <div class="col-12 text-center">
                <p>
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    . All Rights Reserved. &mdash; Designed with love by
                    <a href="https://www.facebook.com/quandh2003.88">Đặng Hồng Quân</a>
                </p>
            </div>
        </div>
    </div>
</div>
<div id="overlayer"></div>
<div class="loader">
    <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('/assetsHome/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/assetsHome/js/tiny-slider.js')}}"></script>
<script src="{{asset('/assetsHome/js/aos.js')}}"></script>
<script src="{{asset('/assetsHome/js/navbar.js')}}"></script>
<script src="{{asset('/assetsHome/js/counter.js')}}"></script>
<script src="{{asset('/assetsHome/js/custom.js')}}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var menuItems = document.querySelectorAll(".nav-link");

        var currentUrl = window.location.href;

        menuItems.forEach(function(item) {
            if (currentUrl === item.href) {
                document.querySelectorAll(".nav-link").forEach(function(link) {
                    link.classList.remove("active");
                });
                item.classList.add("active");
            }
        });
    });
</script>
</body>
</html>
