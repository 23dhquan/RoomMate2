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
        <div class="col-lg-8">
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

            <div class="card chart-card mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-3">Xu Hướng Doanh Thu</h5>
                    <div id="trendLineChart"></div>
                </div>
            </div>

            <div class="card chart-card mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-3">Phân Bổ Chi Phí</h5>
                    <div id="expensePieChart"></div>
                </div>
            </div>
        </div>