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


    <title>RoomMate - House</title>
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
                    <li class="{{ Route::currentRouteName() == 'contact.index' ? 'active' : '' }}">
                        <a href="">Contact Us</a>
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
    style="background-image:  url('{{asset('/assetsHome/images/hero_bg_3.jpg')}}')"

>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up">Nhà Thuê</h1>

                <nav
                    aria-label="breadcrumb"
                    data-aos="fade-up"
                    data-aos-delay="200"
                >
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang Chủ</a></li>
                        <li
                            class="breadcrumb-item active text-white-50"
                            aria-current="page"
                        >
                            Nhà Thuê
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<div class="section section-properties">
    <div class="container">
        <!-- Search and Filter -->
        <div class="row mb-4">
            <div class="col-md-6">
                <input
                    type="text"
                    id="search-description"
                    class="form-control"
                    placeholder="Tìm kiếm theo mô tả"
                />
            </div>
            <div class="col-md-6">
                <select style=" height: 50px !important;" id="filter-price" class="form-select">
                    <option value="">Tất cả mức giá</option>
                    <option value="0-1000000">Dưới 1.000.000</option>
                    <option value="1000000-3000000">1.000.000 - 3.000.000</option>
                    <option value="3000000-5000000">3.000.000 - 5.000.000</option>
                    <option value="5000000">Trên 5.000.000</option>
                </select>
            </div>
        </div>

        <div class="row" id="product-list"></div>

        <div class="row align-items-center py-5">
            <div class="col-lg-12 text-center">
                <button id="load-more-btn" class="btn btn-primary">Xem Thêm</button>
            </div>
        </div>
    </div>

    <div id="house-data" style="display: none;">
        @json($houses)
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
    <!-- /.container -->
</div>
<!-- /.site-footer -->

<!-- Preloader -->
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
<script>
    function formatDescription(description) {
        if (!description) return "N/A";

        // Kiểm tra độ dài và cắt chuỗi nếu cần
        if (description.length > 50) {
            return description.slice(0, 50) + " ..."; // Hiển thị tối đa 50 ký tự
        }

        return description; // Nếu chuỗi ngắn hơn hoặc bằng 50 ký tự, hiển thị toàn bộ
    }

    document.addEventListener("DOMContentLoaded", function () {
        const houseData = JSON.parse(document.getElementById("house-data").textContent);
        const itemsPerLoad = 3; // Hiển thị tối đa 3 sản phẩm mỗi lần load thêm
        let currentIndex = 0;
        let filteredData = [...houseData]; // Dữ liệu được lọc

        const productList = document.getElementById("product-list");
        const loadMoreBtn = document.getElementById("load-more-btn");
        const searchInput = document.getElementById("search-description");
        const filterPrice = document.getElementById("filter-price");

        // Hàm render danh sách sản phẩm
        function renderProducts() {
            const end = currentIndex + itemsPerLoad;
            const currentItems = filteredData.slice(currentIndex, end);

            currentItems.forEach(house => {
                const houseImage = house.house_image || '/assetsHome/images/default.jpg';
                const houseAreaName = house.area_name || "N/A";
                const houseAddressName = house.area_address || "N/A";

                const houseHTML = `
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="property-item mb-30">
                        <a href="{{ url('house-detail/${house.house_id}') }}" class="img">
                            <img  style="width: 100%; height: 500px"  src="${houseImage}" alt="Image" class="img-fluid" />
                        </a>
                        <div class="property-content">
                            <div class="price mb-2"><span>${house.price ? '$' + new Intl.NumberFormat().format(house.price) : 'N/A'}</span></div>
                            <div>
                                <span class="d-block mb-2 text-black-50">${houseAreaName + ', ' + houseAddressName}</span>

                                <span class="city d-block mb-3">${house.name || "N/A"}</span>
                                <span style="margin-top: -10px" class="d-block text-black-50 mb-2">
                                    ${formatDescription(house.description)}
                                </span>



                                <a href="{{ url('house-detail/${house.house_id}') }}" class="btn btn-primary py-2 px-3">Chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
                productList.insertAdjacentHTML("beforeend", houseHTML);
            });

            currentIndex = end;
            if (currentIndex >= filteredData.length) {
                loadMoreBtn.style.display = 'none';
            }
        }

        // Hàm làm mới danh sách sản phẩm
        function refreshProducts() {
            currentIndex = 0;
            productList.innerHTML = "";
            renderProducts();
            loadMoreBtn.style.display = currentIndex < filteredData.length ? 'block' : 'none';
        }

        // Hàm lọc sản phẩm theo mô tả
        function filterProducts() {
            const searchValue = searchInput.value.toLowerCase();
            const priceValue = filterPrice.value;

            filteredData = houseData.filter(house => {
                const matchesDescription = house.description?.toLowerCase().includes(searchValue);
                let matchesPrice = true;

                if (priceValue) {
                    const [min, max] = priceValue.split('-').map(Number);
                    const price = house.price || 0;

                    if (max) {
                        matchesPrice = price >= min && price <= max;
                    } else {
                        matchesPrice = price >= min;
                    }
                }

                return matchesDescription && matchesPrice;
            });

            refreshProducts();
        }

        // Gắn sự kiện cho tìm kiếm và lọc
        searchInput.addEventListener("input", filterProducts);
        filterPrice.addEventListener("change", filterProducts);

        // Gắn sự kiện cho nút "Xem Thêm"
        loadMoreBtn.addEventListener("click", function () {
            renderProducts();
        });

        // Hiển thị sản phẩm ban đầu
        renderProducts();
    });

</script>


</body>

</html>

