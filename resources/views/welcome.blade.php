
<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RoomMate - @yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset("/assets/images/roommate.png")}}" />

    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="{{asset("/assets/css/core/libs.min.css")}}" />

    <!-- Aos Animation Css -->
    <link rel="stylesheet" href="{{asset("/assets/vendor/aos/dist/aos.css")}}" />

    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="{{asset("/assets/css/hope-ui.min.css?v=2.0.0")}}" />

    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset("/assets/css/custom.min.css?v=2.0.0")}}" />

    <!-- Dark Css -->
    <link rel="stylesheet" href="{{asset("/assets/css/dark.min.css")}}"/>

    <!-- Customizer Css -->
    <link rel="stylesheet" href="{{asset("/assets/css/dark.min.css")}}" />

    <!-- RTL Css -->
    <link rel="stylesheet" href="{{asset("/assets/css/rtl.min.css")}}"/>


</head>
<style>
    html, body {
        overflow: hidden;
        overflow-y: scroll;
        scrollbar-width: none;
    }

    body::-webkit-scrollbar {
        display: none;
    }

</style>
<body class="  ">
<div id="loading">
    <div class="loader simple-loader">
        <div class="loader-body"></div>
    </div>
</div>
@include("admin.layout.menu")
<main class="main-content">
    <div class="position-relative iq-banner">

        @include("admin.layout.header")

    </div>
    @yield('content')

    @include("admin.layout.footer")
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset("/assets/js/core/libs.min.js")}}"></script>

<script src="{{asset("/assets/js/core/external.min.js")}}"></script>

<script src="{{asset("/assets/js/charts/widgetcharts.js")}}"></script>

<script src="{{asset("/assets/js/charts/vectore-chart.js")}}"></script>
<script src="{{asset("/assets/js/charts/dashboard.js")}}" ></script>

<script src="{{asset("/assets/js/plugins/fslightbox.js")}}"></script>

<script src="{{asset("/assets/js/plugins/setting.js")}}"></script>

<script src="{{asset("/assets/js/plugins/slider-tabs.js")}}"></script>

<script src="{{asset("/assets/js/plugins/form-wizard.js")}}"></script>

<script src="{{asset("/assets/vendor/aos/dist/aos.js")}}"></script>

<script src="{{asset("/assets/js/hope-ui.js")}}" defer></script>
<script src="https://sandbox.vnpayment.vn/paymentv2/Scripts/jquery-3.6.0.min.js"></script>
<script src="https://sandbox.vnpayment.vn/paymentv2/Scripts/custom.min.js"></script>
<script>
    $(document).ready(function () {
        const tableSelector = $('#datatable');
        if (tableSelector.length) {
            new DataTable(tableSelector, {
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                }
            });
        }
    });



</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var menuItems = document.querySelectorAll(".nav-link");

        var currentUrl = window.location.href;

        menuItems.forEach(function (item) {
            if (currentUrl === item.href) {
                document.querySelectorAll(".nav-link").forEach(function (link) {
                    link.classList.remove("active");
                });
                item.classList.add("active");
            }
        });
    });

</script>
</body>
</html>
