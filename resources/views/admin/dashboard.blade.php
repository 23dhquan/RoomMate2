@extends('welcome')
@section('title', 'Dashboard')

@section('content')
<style>
    .stats-card { border-radius: 15px; border: none; transition: all 0.3s ease; box-shadow: 0 2px 15px rgba(0,0,0,0.1); overflow: hidden; }
    .stats-card:hover { transform: translateY(-5px); box-shadow: 0 5px 25px rgba(0,0,0,0.15); }
    .gradient-water { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .gradient-electric { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .gradient-house { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .gradient-service { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
    .chart-card { border-radius: 15px; border: none; box-shadow: 0 2px 15px rgba(0,0,0,0.1); }
</style>

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row g-3 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card gradient-water text-white">
                <div class="card-body">
                    <h6 class="text-white-50 mb-2">Tổng Tiền Nước</h6>
                    <h3 class="mb-0 fw-bold">{{ number_format($yearlyTotals['water'], 0) }} ₫</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card gradient-electric text-white">
                <div class="card-body">
                    <h6 class="text-white-50 mb-2">Tổng Tiền Điện</h6>
                    <h3 class="mb-0 fw-bold">{{ number_format($yearlyTotals['electricity'], 0) }} ₫</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card gradient-house text-white">
                <div class="card-body">
                    <h6 class="text-white-50 mb-2">Tổng Tiền Nhà</h6>
                    <h3 class="mb-0 fw-bold">{{ number_format($yearlyTotals['house_bill'], 0) }} ₫</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card stats-card gradient-service text-white">
                <div class="card-body">
                    <h6 class="text-white-50 mb-2">Tổng Tiền Dịch Vụ</h6>
                    <h3 class="mb-0 fw-bold">{{ number_format($totalPrice) }} ₫</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection