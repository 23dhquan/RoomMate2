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

    <div class="hero">
        <div class="hero-slide">
            <div class="img overlay" style="background-image: url('{{asset('/assetsHome/images/hero_bg_3.jpg')}}')">
            </div>
            <div class="img overlay" style="background-image: url('{{asset('/assetsHome/images/hero_bg_2.jpg')}}')">
            </div>
            <div class="img overlay" style="background-image: url('{{asset('/assetsHome/images/hero_bg_1.jpg')}}')">
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-9 text-center">
                    <h1 class="heading" data-aos="fade-up">
                        Chào mừng bạn đến với hệ thống ROOMMATE
                    </h1>

                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="font-weight-bold text-primary heading">
                        Nhà cho thuê
                    </h2>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <p>
                        <a href="{{route('home.house')}}" target="_blank" class="btn btn-primary text-white py-3 px-4">Xem tất cả</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="property-slider-wrap">
                        <div class="property-slider">
                            @foreach ($houses as $house)
                            <div class="property-item">
                                {{--                                <a href="{{ route('property.details', $house->house_id) }}"
                                class="img">--}}

                                <a href="{{ route('home.show', $house->house_id) }}" class="img">
                                    <img style="width: 100%; height: 400px; " src="{{asset($house->house_image)}}" alt="{{ $house->name }}"
                                        class="img-fluid" />
                                </a>

                                <div class="property-content">
                                    <div class="price mb-2">
                                        <span>${{ number_format($house->price, 0, '.', ',') }}</span>
                                    </div>
                                    <div>
                                        <span class="d-block mb-2 text-black-50">
                                            {{ $house->getAreaName() . ', ' . $house->getAreaAddress() }}
                                        </span>

                                        <span class="city d-block mb-3">
                                            {{ $house->name ?? 'Unknown Area' }}
                                        </span>
                                        <span class="d-block mb-2 text-black-50">
                                            {{ \Illuminate\Support\Str::limit($house->description, 50) }}
                                        </span>



                                        <a href="{{ route('home.show', $house->house_id) }}" class="btn btn-primary py-2 px-3">
                                            Chi tiết
                                        </a>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div id="property-nav" class="controls" tabindex="0" aria-label="Carousel Navigation">
                            <span class="prev" data-controls="prev" aria-controls="property" tabindex="-1">Prev</span>
                            <span class="next" data-controls="next" aria-controls="property" tabindex="-1">Next</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <section class="features-1">
        <div class="container">
            <div class="row">
                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="box-feature">
                        <span class="flaticon-house"></span>
                        <h3 class="mb-3">Our Properties</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Voluptates, accusamus.
                        </p>
                        <p><a href="#" class="learn-more">Learn More</a></p>
                    </div>
                </div>
                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                    <div class="box-feature">
                        <span class="flaticon-building"></span>
                        <h3 class="mb-3">Property for Sale</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Voluptates, accusamus.
                        </p>
                        <p><a href="#" class="learn-more">Learn More</a></p>
                    </div>
                </div>
                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="box-feature">
                        <span class="flaticon-house-3"></span>
                        <h3 class="mb-3">Real Estate Agent</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Voluptates, accusamus.
                        </p>
                        <p><a href="#" class="learn-more">Learn More</a></p>
                    </div>
                </div>
                <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                    <div class="box-feature">
                        <span class="flaticon-house-1"></span>
                        <h3 class="mb-3">House for Sale</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Voluptates, accusamus.
                        </p>
                        <p><a href="#" class="learn-more">Learn More</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="section sec-testimonials">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-md-6">
                    <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">
                        Khách Hàng
                    </h2>
                </div>
                <div class="col-md-6 text-md-end">
                    <div id="testimonial-nav">
                        <span class="prev" data-controls="prev">Prev</span>

                        <span class="next" data-controls="next">Next</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4"></div>
            </div>
            <div class="testimonial-slider-wrap">
                <div class="testimonial-slider">
                    <div class="item">
                        <div class="testimonial">
                            <img src="{{asset('/assets/images/avatars/avatar-me.png')}}"  alt="Image" class="img-fluid rounded-circle w-25 mb-4" />
                            <div class="rate">
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                            </div>
                            <h3 class="h5 text-primary mb-4">Đặng Hồng Quân</h3>
                            <blockquote>
                                <p>
                                    &ldquo;Far far away, behind the word mountains, far from the
                                    countries Vokalia and Consonantia, there live the blind
                                    texts. Separated they live in Bookmarksgrove right at the
                                    coast of the Semantics, a large language ocean.&rdquo;
                                </p>
                            </blockquote>
                            <p class="text-black-50">Designer, Co-founder</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial">
                            <img src="{{asset('/assets/images/avatars/avatar-me.png')}}"  alt="Image" class="img-fluid rounded-circle w-25 mb-4" />
                            <div class="rate">
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                            </div>
                            <h3 class="h5 text-primary mb-4">Đặng Hồng Quân</h3>
                            <blockquote>
                                <p>
                                    &ldquo;Far far away, behind the word mountains, far from the
                                    countries Vokalia and Consonantia, there live the blind
                                    texts. Separated they live in Bookmarksgrove right at the
                                    coast of the Semantics, a large language ocean.&rdquo;
                                </p>
                            </blockquote>
                            <p class="text-black-50">Designer, Co-founder</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial">
                            <img src="{{asset('/assets/images/avatars/avatar-me.png')}}"  alt="Image" class="img-fluid rounded-circle w-25 mb-4" />
                            <div class="rate">
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                            </div>
                            <h3 class="h5 text-primary mb-4">Đặng Hồng Quân</h3>
                            <blockquote>
                                <p>
                                    &ldquo;Far far away, behind the word mountains, far from the
                                    countries Vokalia and Consonantia, there live the blind
                                    texts. Separated they live in Bookmarksgrove right at the
                                    coast of the Semantics, a large language ocean.&rdquo;
                                </p>
                            </blockquote>
                            <p class="text-black-50">Designer, Co-founder</p>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimonial">
                            <img src="{{asset('/assets/images/avatars/avatar-me.png')}}"  alt="Image" class="img-fluid rounded-circle w-25 mb-4" />
                            <div class="rate">
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                            </div>
                            <h3 class="h5 text-primary mb-4">Đặng Hồng Quân</h3>
                            <blockquote>
                                <p>
                                    &ldquo;Far far away, behind the word mountains, far from the
                                    countries Vokalia and Consonantia, there live the blind
                                    texts. Separated they live in Bookmarksgrove right at the
                                    coast of the Semantics, a large language ocean.&rdquo;
                                </p>
                            </blockquote>
                            <p class="text-black-50">Designer, Co-founder</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-4 bg-light">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-5">
                    <h2 class="font-weight-bold heading text-primary mb-4">
                        Hãy tìm ngôi nhà hoàn hảo cho bạn
                    </h2>
                    <p class="text-black-50">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam
                        enim pariatur similique debitis vel nisi qui reprehenderit.
                    </p>
                </div>
            </div>
            <div class="row justify-content-between mb-5">
                <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2">
                    <div class="img-about dots">
                        <img src="{{asset('/assetsHome/images/hero_bg_3.jpg')}}" alt="Image" class="img-fluid" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex feature-h">
                        <span class="wrap-icon me-3">
                            <span class="icon-home2"></span>
                        </span>
                        <div class="feature-text">
                            <h3 class="heading">2M Properties</h3>
                            <p class="text-black-50">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Nostrum iste.
                            </p>
                        </div>
                    </div>

                    <div class="d-flex feature-h">
                        <span class="wrap-icon me-3">
                            <span class="icon-person"></span>
                        </span>
                        <div class="feature-text">
                            <h3 class="heading">Top Rated Agents</h3>
                            <p class="text-black-50">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Nostrum iste.
                            </p>
                        </div>
                    </div>

                    <div class="d-flex feature-h">
                        <span class="wrap-icon me-3">
                            <span class="icon-security"></span>
                        </span>
                        <div class="feature-text">
                            <h3 class="heading">Legit Properties</h3>
                            <p class="text-black-50">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Nostrum iste.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row section-counter mt-5">
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span class="countup text-primary">3298</span></span>
                        <span class="caption text-black-50"># of Buy Properties</span>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span class="countup text-primary">2181</span></span>
                        <span class="caption text-black-50"># of Sell Properties</span>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span class="countup text-primary">9316</span></span>
                        <span class="caption text-black-50"># of All Properties</span>
                    </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number"><span class="countup text-primary">7191</span></span>
                        <span class="caption text-black-50"># of Agents</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="row justify-content-center footer-cta" data-aos="fade-up">
            <div class="col-lg-7 mx-auto text-center">
                <h2 class="mb-4">Hãy trở thành một phần trong đội ngũ chúng tôi</h2>
                <p>

                </p>
            </div>
            <!-- /.col-lg-7 -->
        </div>
        <!-- /.row -->
    </div>

    <div class="section section-5 bg-light">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-6 mb-5">
                    <h2 class="font-weight-bold heading text-primary mb-4">
                        ĐỘI NGŨ CHÚNG TÔI
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
                    <div class="h-100 person">
                        <img  style="height: 27%" src="{{asset('/assets/images/avatars/z5913516510676_a6e49d0dd874b952d9253eb039ee7bc8.jpg')}}" alt="Image" class="img-fluid" />

                        <div class="person-contents">
                            <h2 class="mb-0"><a href="#">Đặng Hồng Quân</a></h2>
                            <span class="meta d-block mb-3">Dev</span>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Facere officiis inventore cumque tenetur laboriosam, minus
                                culpa doloremque odio, neque molestias?
                            </p>

                            <ul class="social list-unstyled list-inline dark-hover">
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-twitter"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-facebook"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-linkedin"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-instagram"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
                    <div class="h-100 person">
                        <img  style="height: 27%" src="{{asset('/assets/images/avatars/z5913516510676_a6e49d0dd874b952d9253eb039ee7bc8.jpg')}}" alt="Image" class="img-fluid" />

                        <div class="person-contents">
                            <h2 class="mb-0"><a href="#">Đặng Hồng Quân</a></h2>
                            <span class="meta d-block mb-3">Dev</span>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Facere officiis inventore cumque tenetur laboriosam, minus
                                culpa doloremque odio, neque molestias?
                            </p>

                            <ul class="social list-unstyled list-inline dark-hover">
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-twitter"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-facebook"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-linkedin"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-instagram"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0">
                    <div class="h-100 person">
                        <img style="height: 27%" src="{{asset('/assets/images/avatars/z5913516510676_a6e49d0dd874b952d9253eb039ee7bc8.jpg')}}" alt="Image" class="img-fluid" />

                        <div class="person-contents">
                            <h2 class="mb-0"><a href="#">Đặng Hồng Quân</a></h2>
                            <span class="meta d-block mb-3">Dev</span>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Facere officiis inventore cumque tenetur laboriosam, minus
                                culpa doloremque odio, neque molestias?
                            </p>

                            <ul class="social list-unstyled list-inline dark-hover">
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-twitter"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-facebook"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-linkedin"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#"><span class="icon-instagram"></span></a>
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
                </div>
            </div>

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
