{{-- @extends('welcome')
@section('title', 'Dashboard')

@section('content')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">

            <div class="row">
                <div class="col-md-12 col-lg-3">
                    <div  class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                        <div  class="card-body">
                            <div  class="progress-widget">
                                <div  id="circle-progress-01" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="90" data-type="percent">
                                    <svg class="card-slie-arrow icon-24" width="24"  viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                    </svg>
                                </div>
                                <div class="progress-detail">
                                    <p  class="mb-2">Tổng Tiền Nước</p>
                                    <h4 class="counter">{{ number_format($yearlyTotals['water'], 0) }} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-3">
                    <div   class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="800">
                        <div class="card-body">
                            <div class="progress-widget">
                                <div id="circle-progress-02" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                                    <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                    </svg>
                                </div>
                                <div class="progress-detail">
                                    <p class="mb-2">Tổng Tiền Điện</p>
                                    <h4  class="counter">{{ number_format($yearlyTotals['electricity'], 0) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-3">
                    <div class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="900">
                        <div class="card-body">
                            <div class="progress-widget">
                                <div id="circle-progress-03" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="70" data-type="percent">
                                    <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                    </svg>
                                </div>
                                <div class="progress-detail">
                                    <p  class="mb-2">Tổng Tiền Nhà</p>
                                    <h4 class="counter">{{ number_format($yearlyTotals['house_bill'], 0) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-3">
                    <div class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1000">
                        <div class="card-body">
                            <div class="progress-widget">
                                <div id="circle-progress-04" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="60" data-type="percent">
                                    <svg class="card-slie-arrow icon-24" width="24px"  viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                    </svg>
                                </div>
                                <div class="progress-detail">
                                    <p  class="mb-2">Tổng Tiền DV</p>
                                    <h4 class="counter">{{ number_format($totalPrice)}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-8">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="card" data-aos="fade-up" data-aos-delay="900">
                            <form action="{{ route('dashboard') }}" method="GET" id="yearForm" class=" mt-2 ms-2">
                                <label for="year">Chọn năm:</label>
                                <select  id="year" name="year" onchange="this.form.submit()">
                                    <option class="form-select" value="" disabled selected>Chọn năm</option>
                                    @for ($i = 2022; $i <= \Carbon\Carbon::now()->year; $i++)
                                        <option  value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>

                            </form>
                            <div id="monthlyAmountChart"></div>
                        </div>
                    </div>



                </div>
            </div>
            <div class="col-md-12 col-lg-4">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card credit-card-widget" data-aos="fade-up" data-aos-delay="900">
                            <div class="pb-4 border-0 card-header">
                                <div class="p-4 border border-white rounded primary-gradient-card">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="font-weight-bold">VISA </h5>
                                            <P class="mb-0">PREMIUM ACCOUNT</P>
                                        </div>
                                        <div class="master-card-content">
                                            <svg class="master-card-1 icon-60" width="60"  viewBox="0 0 24 24">
                                                <path fill="#ffffff" d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                            </svg>
                                            <svg class="master-card-2 icon-60" width="60"  viewBox="0 0 24 24">
                                                <path fill="#ffffff" d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="my-4">
                                        <div class="card-number">
                                            <span class="fs-5 me-2">5789</span>
                                            <span class="fs-5 me-2">****</span>
                                            <span class="fs-5 me-2">****</span>
                                            <span class="fs-5">2847</span>
                                        </div>
                                    </div>
                                    <div class="mb-2 d-flex align-items-center justify-content-between">
                                        <p class="mb-0">Card holder</p>
                                        <p class="mb-0">Expire Date</p>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6>Mike Smith</h6>
                                        <h6 class="ms-5">06/11</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="flex-wrap mb-4 d-flex align-itmes-center justify-content-between">
                                    <div class="d-flex align-itmes-center me-0 me-md-4">
                                        <div>
                                            <div class="p-3 mb-2 rounded bg-soft-primary">
                                                <svg style="width: 20px; height: 20px" class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M17.8877 10.8967C19.2827 10.7007 20.3567 9.50473 20.3597 8.05573C20.3597 6.62773 19.3187 5.44373 17.9537 5.21973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M19.7285 14.2505C21.0795 14.4525 22.0225 14.9255 22.0225 15.9005C22.0225 16.5715 21.5785 17.0075 20.8605 17.2815" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8867 14.6638C8.67273 14.6638 5.92773 15.1508 5.92773 17.0958C5.92773 19.0398 8.65573 19.5408 11.8867 19.5408C15.1007 19.5408 17.8447 19.0588 17.8447 17.1128C17.8447 15.1668 15.1177 14.6638 11.8867 14.6638Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8869 11.888C13.9959 11.888 15.7059 10.179 15.7059 8.069C15.7059 5.96 13.9959 4.25 11.8869 4.25C9.7779 4.25 8.0679 5.96 8.0679 8.069C8.0599 10.171 9.7569 11.881 11.8589 11.888H11.8869Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M5.88509 10.8967C4.48909 10.7007 3.41609 9.50473 3.41309 8.05573C3.41309 6.62773 4.45409 5.44373 5.81909 5.21973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M4.044 14.2505C2.693 14.4525 1.75 14.9255 1.75 15.9005C1.75 16.5715 2.194 17.0075 2.912 17.2815" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h5>{{$toltalTenant}}</h5>
                                            <small class="mb-0">Khách Hàng</small>
                                        </div>
                                    </div>
                                    <div class="d-flex align-itmes-center">
                                        <div>
                                            <div class="p-3 mb-2 rounded bg-soft-info">
                                                <svg style="width: 20px; height: 20px" class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M9.15722 20.7714V17.7047C9.1572 16.9246 9.79312 16.2908 10.581 16.2856H13.4671C14.2587 16.2856 14.9005 16.9209 14.9005 17.7047V17.7047V20.7809C14.9003 21.4432 15.4343 21.9845 16.103 22H18.0271C19.9451 22 21.5 20.4607 21.5 18.5618V18.5618V9.83784C21.4898 9.09083 21.1355 8.38935 20.538 7.93303L13.9577 2.6853C12.8049 1.77157 11.1662 1.77157 10.0134 2.6853L3.46203 7.94256C2.86226 8.39702 2.50739 9.09967 2.5 9.84736V18.5618C2.5 20.4607 4.05488 22 5.97291 22H7.89696C8.58235 22 9.13797 21.4499 9.13797 20.7714V20.7714" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <h5>{{$toltalHouse}}</h5>
                                            <small class="mb-0">Phòng Thuê</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="flex-wrap d-flex justify-content-between">
                                        <h3  class="mb-4 mt-2">Tổng Danh Thu</h3>

                                    </div>
                                    <h2 class="mb-2">{{ number_format($totalAmountAll)}} VNĐ</h2>

                                </div>

                            </div>
                        </div>
                        <div class="card" data-aos="fade-up" data-aos-delay="500">
                            <div class="text-center card-body d-flex justify-content-around">
                                <div>
                                    <h2 class="mb-2">750<small>K</small></h2>
                                    <p class="mb-0 text-gray">Website Visitors</p>
                                </div>
                                <hr class="hr-vertial">
                                <div>
                                    <h2 class="mb-2">7,500</h2>
                                    <p class="mb-0 text-gray">New Customers</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var options = {
            chart: {
                type: 'bar',
                height: 650
            },
            series: [{
                name: 'Tổng tiền',
                data: [
                    @for($i = 1; $i <= 12; $i++)
                        {{ $monthlyTotals[$i] ?? 0 }},
                    @endfor
                ]
            }],
            xaxis: {
                categories: [
                    'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                    'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                ],
            },
            fill: {
                opacity: 1,
                colors: ['#008FFB'],
            },
            dataLabels: {
                enabled: false,
            },
            title: {
                text: 'Tổng tiền thanh toán theo từng tháng',
                align: 'center',
                style: {
                    fontSize: '18px',
                    fontWeight: 'bold'
                }
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return value.toLocaleString() + ' VND';
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#monthlyAmountChart"), options);
        chart.render();
    </script>
    @endsection --}}


    @extends('welcome')
@section('title', 'Dashboard')

@section('content')
<style>
    .stats-card {
        border-radius: 15px;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 25px rgba(0,0,0,0.15);
    }
    
    .gradient-water {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .gradient-electric {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .gradient-house {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .gradient-service {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }
    
    .chart-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
    }
    
    .premium-card {
        border-radius: 15px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
    }
    
    .year-selector-wrapper {
        position: relative;
        display: inline-block;
    }
    
    .year-btn {
        border-radius: 10px;
        border: 2px solid #667eea;
        background: white;
        color: #667eea;
        padding: 10px 20px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .year-btn:hover {
        background: #667eea;
        color: white;
    }
    
    .year-dropdown {
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 5px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        z-index: 1000;
        min-width: 150px;
        display: none;
    }
    
    .year-dropdown.show {
        display: block;
    }
    
    .year-item {
        padding: 10px 20px;
        cursor: pointer;
        transition: all 0.2s ease;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .year-item:first-child {
        border-radius: 10px 10px 0 0;
    }
    
    .year-item:last-child {
        border-radius: 0 0 10px 10px;
        border-bottom: none;
    }
    
    .year-item:hover {
        background: #f8f9fa;
        color: #667eea;
    }
    
    .year-item.active {
        background: #667eea;
        color: white;
    }
    
    @media (max-width: 768px) {
        .chart-card {
            margin-bottom: 1rem;
        }
    }
</style>

<div class="container-fluid content-inner mt-n5 py-0">
    <!-- Stats Cards Row -->
    <div class="row g-3 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card gradient-water text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <svg width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 16a6 6 0 0 0 6-6c0-1.655-1.122-2.904-2.432-4.362C10.254 4.176 8.75 2.503 8 0c0 0-6 5.686-6 10a6 6 0 0 0 6 6ZM6.646 4.646l.708.708c-.29.29-1.128 1.311-1.907 2.87l-.894-.448c.82-1.641 1.717-2.753 2.093-3.13Z"/>
                            </svg>
                        </div>
                        <div class="ms-auto">
                            <h6 class="mb-0 text-white-50">Năm <span id="year-label-1">{{ request('year', \Carbon\Carbon::now()->year) }}</span></h6>
                        </div>
                    </div>
                    <h6 class="text-white-50 mb-2">Tổng Tiền Nước</h6>
                    <h3 class="mb-0 fw-bold" id="water-total">{{ number_format($yearlyTotals['water'], 0) }} ₫</h3>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card gradient-electric text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <svg width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z"/>
                            </svg>
                        </div>
                        <div class="ms-auto">
                            <h6 class="mb-0 text-white-50">Năm <span id="year-label-2">{{ request('year', \Carbon\Carbon::now()->year) }}</span></h6>
                        </div>
                    </div>
                    <h6 class="text-white-50 mb-2">Tổng Tiền Điện</h6>
                    <h3 class="mb-0 fw-bold" id="electric-total">{{ number_format($yearlyTotals['electricity'], 0) }} ₫</h3>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card gradient-house text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <svg width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"/>
                            </svg>
                        </div>
                        <div class="ms-auto">
                            <h6 class="mb-0 text-white-50">Năm <span id="year-label-3">{{ request('year', \Carbon\Carbon::now()->year) }}</span></h6>
                        </div>
                    </div>
                    <h6 class="text-white-50 mb-2">Tổng Tiền Nhà</h6>
                    <h3 class="mb-0 fw-bold" id="house-total">{{ number_format($yearlyTotals['house_bill'], 0) }} ₫</h3>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card gradient-service text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <svg width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5Z"/>
                            </svg>
                        </div>
                        <div class="ms-auto">
                            <h6 class="mb-0 text-white-50">Năm <span id="year-label-4">{{ request('year', \Carbon\Carbon::now()->year) }}</span></h6>
                        </div>
                    </div>
                    <h6 class="text-white-50 mb-2">Tổng Tiền Dịch Vụ</h6>
                    <h3 class="mb-0 fw-bold" id="service-total">{{ number_format($totalPrice) }} ₫</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <!-- Charts Section -->
        <div class="col-lg-8">
            <!-- Bar Chart -->
            <div class="card chart-card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                        <h5 class="card-title mb-0">Biểu Đồ Doanh Thu Theo Tháng</h5>
                        <div class="year-selector-wrapper">
                            <button class="year-btn" id="yearButton" type="button">
                                Năm <span id="selected-year">{{ request('year', \Carbon\Carbon::now()->year) }}</span>
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                </svg>
                            </button>
                            <div class="year-dropdown" id="yearDropdown">
                                @for ($i = \Carbon\Carbon::now()->year; $i >= 2022; $i--)
                                    <div class="year-item {{ request('year', \Carbon\Carbon::now()->year) == $i ? 'active' : '' }}" data-year="{{ $i }}">
                                        {{ $i }}
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div id="monthlyBarChart"></div>
                </div>
            </div>

            <!-- Line Chart -->
            <div class="card chart-card mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-3">Xu Hướng Doanh Thu</h5>
                    <div id="trendLineChart"></div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="card chart-card mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-3">Phân Bổ Chi Phí</h5>
                    <div id="expensePieChart"></div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="col-lg-4">
            <!-- Premium Card -->
            <div class="card premium-card text-white mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h6 class="text-white-50 mb-1">PREMIUM ACCOUNT</h6>
                            <h5 class="mb-0">VISA CARD</h5>
                        </div>
                        <div class="d-flex">
                            <div class="bg-white bg-opacity-25 rounded-circle" style="width: 40px; height: 40px;"></div>
                            <div class="bg-white bg-opacity-25 rounded-circle ms-n3" style="width: 40px; height: 40px;"></div>
                        </div>
                    </div>
                    
                    <div class="bg-white bg-opacity-25 rounded mb-3" style="width: 50px; height: 35px;"></div>
                    
                    <div class="mb-4">
                        <div class="d-flex gap-3">
                            <span class="fs-5">5789</span>
                            <span class="fs-5">****</span>
                            <span class="fs-5">****</span>
                            <span class="fs-5">2847</span>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-white-50 mb-1 small">Card Holder</p>
                            <h6 class="mb-0">Mike Smith</h6>
                        </div>
                        <div>
                            <p class="text-white-50 mb-1 small">Expire Date</p>
                            <h6 class="mb-0">06/11</h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Stats -->
            <div class="card chart-card mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-4">Tổng Quan</h5>
                    
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <svg width="24" height="24" fill="currentColor" class="text-primary" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                                <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5Z"/>
                            </svg>
                        </div>
                        <div class="ms-3">
                            <h4 class="mb-0">{{$toltalTenant}}</h4>
                            <p class="text-muted mb-0 small">Khách Hàng</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <svg width="24" height="24" fill="currentColor" class="text-info" viewBox="0 0 16 16">
                                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"/>
                            </svg>
                        </div>
                        <div class="ms-3">
                            <h4 class="mb-0">{{$toltalHouse}}</h4>
                            <p class="text-muted mb-0 small">Phòng Thuê</p>
                        </div>
                    </div>
                    
                    <div class="bg-light rounded p-3">
                        <h6 class="text-muted mb-2">Tổng Doanh Thu</h6>
                        <h3 class="text-primary mb-0 fw-bold" id="total-revenue">{{ number_format($totalAmountAll)}} ₫</h3>
                    </div>
                </div>
            </div>

            <!-- Radial Chart -->
            <div class="card chart-card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Tỷ Lệ Phân Bổ Chi Phí</h5>
                    <div id="radialChart"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Global charts
    let barChart, lineChart, pieChart, radialChart;
    
    // Data
    let monthlyData = [
        @for($i = 1; $i <= 12; $i++)
            {{ $monthlyTotals[$i] ?? 0 }},
        @endfor
    ];
    
    const categories = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                     'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];

    // Initialize Charts
    function initCharts() {
        // 1. Bar Chart
        const barOptions = {
            series: [{
                name: 'Doanh Thu',
                data: monthlyData
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 8,
                    columnWidth: '60%',
                }
            },
            colors: ['#667eea'],
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: categories,
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return (value / 1000000).toFixed(1) + 'M';
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return value.toLocaleString() + ' VND';
                    }
                }
            },
            grid: {
                borderColor: '#f1f1f1',
            }
        };
        barChart = new ApexCharts(document.querySelector("#monthlyBarChart"), barOptions);
        barChart.render();

        // 2. Line Chart
        const lineOptions = {
            series: [{
                name: 'Doanh Thu',
                data: monthlyData
            }],
            chart: {
                type: 'line',
                height: 300,
                toolbar: {
                    show: false
                }
            },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            colors: ['#f093fb'],
            xaxis: {
                categories: categories,
            },
            yaxis: {
                labels: {
                    formatter: function(value) {
                        return (value / 1000000).toFixed(1) + 'M';
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return value.toLocaleString() + ' VND';
                    }
                }
            },
            markers: {
                size: 5,
                colors: ['#f093fb'],
                strokeWidth: 2,
                hover: {
                    size: 7
                }
            },
            grid: {
                borderColor: '#f1f1f1',
            }
        };
        lineChart = new ApexCharts(document.querySelector("#trendLineChart"), lineOptions);
        lineChart.render();

        // 3. Pie Chart
        const pieOptions = {
            series: [
                {{ $yearlyTotals['water'] }},
                {{ $yearlyTotals['electricity'] }},
                {{ $yearlyTotals['house_bill'] }},
                {{ $totalPrice }}
            ],
            chart: {
                type: 'donut',
                height: 320
            },
            labels: ['Tiền Nước', 'Tiền Điện', 'Tiền Nhà', 'Dịch Vụ'],
            colors: ['#667eea', '#f093fb', '#4facfe', '#43e97b'],
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val.toFixed(1) + '%';
                }
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return value.toLocaleString() + ' VND';
                    }
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%'
                    }
                }
            }
        };
        pieChart = new ApexCharts(document.querySelector("#expensePieChart"), pieOptions);
        pieChart.render();

        // 4. Radial Chart - Tỷ lệ % theo tổng doanh thu
        const totalAmount = {{ $totalAmountAll > 0 ? $totalAmountAll : 1 }};
        const waterPercent = ({{ $yearlyTotals['water'] }} / totalAmount * 100).toFixed(1);
        const electricPercent = ({{ $yearlyTotals['electricity'] }} / totalAmount * 100).toFixed(1);
        const housePercent = ({{ $yearlyTotals['house_bill'] }} / totalAmount * 100).toFixed(1);
        const servicePercent = ({{ $totalPrice }} / totalAmount * 100).toFixed(1);
        
        const radialOptions = {
            series: [
                parseFloat(waterPercent), 
                parseFloat(electricPercent), 
                parseFloat(housePercent), 
                parseFloat(servicePercent)
            ],
            chart: {
                height: 280,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '14px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'Tổng',
                            formatter: function (w) {
                                return '100%'
                            }
                        }
                    }
                }
            },
            labels: ['Nước', 'Điện', 'Nhà', 'DV'],
            colors: ['#667eea', '#f093fb', '#4facfe', '#43e97b'],
            legend: {
                show: true,
                position: 'bottom',
                fontSize: '12px',
                formatter: function(seriesName, opts) {
                    return seriesName + ': ' + opts.w.globals.series[opts.seriesIndex].toFixed(1) + '%'
                }
            }
        };
        radialChart = new ApexCharts(document.querySelector("#radialChart"), radialOptions);
        radialChart.render();
    }

    // Year Selector Dropdown
    document.getElementById('yearButton').addEventListener('click', function(e) {
        e.stopPropagation();
        document.getElementById('yearDropdown').classList.toggle('show');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function() {
        document.getElementById('yearDropdown').classList.remove('show');
    });

    // Year selection
    document.querySelectorAll('.year-item').forEach(item => {
        item.addEventListener('click', function() {
            const selectedYear = this.dataset.year;
            
            // Update URL and fetch new data
            window.location.href = '{{ route("dashboard") }}?year=' + selectedYear;
        });
    });

    // Initialize charts on page load
    document.addEventListener('DOMContentLoaded', function() {
        initCharts();
    });
</script>
@endsection