@extends('welcome')
@section('title', 'Hóa Đơn Thanh Toán')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0" style="margin-top: 40px !important;">
        <h2 class="text-center">Hóa Đơn Thanh Toán</h2>

        @php
            $currentMonth = request('month', Carbon\Carbon::now()->month);
            $currentYear = request('year', Carbon\Carbon::now()->year);
        @endphp

        <form method="GET" action="{{ route('bill.filter') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="month">Chọn Tháng:</label>
                    <select name="month" id="month" class="form-control">
                        <option value="">Chọn Tháng</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $currentMonth == $i ? 'selected' : '' }}>
                                {{ sprintf('%02d', $i) }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="year">Chọn Năm:</label>
                    <select name="year" id="year" class="form-control">
                        <option value="">Chọn Năm</option>
                        @for ($i = 2020; $i <= Carbon\Carbon::now()->year; $i++)
                            <option value="{{ $i }}" {{ $currentYear == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end mt-2">
                    <button type="submit" class="btn btn-primary">Lọc</button>
                </div>
            </div>
        </form>


    @foreach ($waterBills as $index => $waterBill)
        <div class="card mt-4">
            <div class="card-header ">
                <h4>Hóa Đơn Nước</h4>
                @if($waterBill->status == 1)
                <span class="badge status-badge bg-success }}">
                      Đã Thanh Toán
                </span>
                @endif
            </div>
            <div class="card-body">
                @if($waterBills->isEmpty())
                    <p class="text-center">Không có hóa đơn nước nào.</p>
                @else
                   <div class="table-responsive">
                       <table class="table table-striped">
                           <thead>
                           <tr>
                               <th>Nhà</th>
                               <th>Ngày Hóa Đơn</th>
                               <th>Số Nước</th>
                               <th>Số Tiền (VND)</th>
                           </tr>
                           </thead>
                           <tbody>

                           <tr>
                               <td>{{ $waterBill->house_name }}</td>
                               <td>{{ \Carbon\Carbon::parse($waterBill->billing_date)->format('d/m/Y') }}</td>
                               <td>{{ $waterBill->water_reading }}</td>

                               <td>{{ number_format($waterBill->amount, 0) }} VND</td>
                           </tr>

                           </tbody>
                       </table>
                   </div>
                @endif
            </div>
        </div>
        @endforeach
        <!-- Hóa đơn điện -->
        @foreach ($electricityBills as $index => $electricityBill)
        <div class="card mt-4">
            <div class="card-header">
                <h4>Hóa Đơn Điện</h4>
                @if($electricityBill->status == 1)
                <span class="badge status-badge bg-success }}">
                      Đã Thanh Toán
                </span>
                @endif
            </div>
            <div class="card-body">
                @if($electricityBills->isEmpty())
                    <p class="text-center">Không có hóa đơn điện nào.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nhà</th>
                                <th>Ngày Hóa Đơn</th>
                                <th>Số Điện</th>
                                <th>Số Tiền (VND)</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $electricityBill->house_name }}

                                <td>{{ \Carbon\Carbon::parse($electricityBill->billing_date)->format('d/m/Y') }}</td>
                                <td>{{ $electricityBill->electricity_reading }}

                                <td>{{ number_format($electricityBill->amount, 0) }} VND</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        @endforeach
        @if($totalAmount != 0)
        <!-- Tổng tiền -->
        <div class="card mt-4">
            <div class="card-header">
                <h4>Tổng Tiền Hóa Đơn</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Loại Hóa Đơn</th>
                        <th>Tổng Tiền (VND)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @if($totalHouseAmount !=0)
                        <td>Tiền Nhà</td>
                        <td>{{ number_format($totalHouseAmount, 0) }} VND</td>
                        @endif
                    </tr>
                    <tr>
                        @if ($totalWaterAmount != 0)
                        <td>Tiền Nước</td>
                        <td>{{ number_format($totalWaterAmount, 0) }} VND</td>
                        @endif
                    </tr>
                    <tr>
                        @if($totalElectricityAmount !=0)
                        <td>Tiền Điện</td>
                        <td>{{ number_format($totalElectricityAmount, 0) }} VND</td>
                        @endif
                    </tr>
                    <tr>
                        <td><strong>Tổng Cộng</strong></td>
                        <td><strong>{{ number_format($totalAmount, 0) }} VND</strong></td>
                    </tr>
                    <tr>
                        <td>Thanh Toán</td>
                        <td>
                            <form action="{{ route('vnpay.pay') }}" method="POST">
                                @csrf
                                <table>
                                    <tr>
                                        <td><strong>{{ number_format($totalAmount, 0) }} VND</strong></td>
                                    </tr>
                                </table>

                                <!-- Order Details -->
                                <input type="hidden" name="order_id" value="{{ uniqid() }}">
                                <input type="hidden" name="amount" value="{{ $totalAmount }}">
                                <input type="hidden" name="order_desc" value="Thanh toán đơn hàng tại RoomMate">
                                <input type="hidden" name="language" value="vn">
                                <input type="hidden" name="customer_name" value="{{ Auth::user()->name }}">
                                <input type="hidden" name="customer_email" value="{{ Auth::user()->email }}">
                                <input type="hidden" name="customer_phone" value=" ">
                                <input type="hidden" name="customer_address" value=" ">

                                @foreach($waterBills as $waterBill)
                                    @if($waterBill->status == 0)
                                        <input type="hidden" name="water_bill_id" value="{{ $waterBill->water_bill_id }}">
                                    @endif
                                @endforeach

                                @foreach($electricityBills as $electricityBill)
                                    @if($electricityBill->status == 0)
                                        <input type="hidden" name="electricity_bill_id" value="{{ $electricityBill->electricity_bill_id }}">
                                    @endif
                                @endforeach

                                @foreach($houseBills as $houseBill)
                                    @if($houseBill->status == 0)
                                        <input type="hidden" name="house_bill_id" value="{{ $houseBill->house_bill_id }}">
                                    @endif
                                @endforeach


                                @if($totalAmount !=0)
                                    <button type="submit" class="btn btn-success">Thanh toán</button>

                                @endif
                            </form>



                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
@endsection
