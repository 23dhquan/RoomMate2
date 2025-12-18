@extends('welcome')
@section('title', 'Hóa Đơn Phạt')

@section('content')
    <div class="container-fluid content-inner mt-5 py-0" style="margin-top: 40px !important;">
        <h2 class="text-center">Hóa Đơn Phạt</h2>

        <!-- Bộ lọc tháng -->
        <form method="GET" action="{{ route('penalty.filter') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="month">Chọn Tháng:</label>
                    <select name="month" id="month" class="form-control">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}"
                                {{ $i == request('month', $selectedMonth) ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="year">Chọn Năm:</label>
                    <select name="year" id="year" class="form-control">
                        @for ($i = now()->year - 10; $i <= now()->year + 1; $i++)
                            <option value="{{ $i }}"
                                {{ $i == request('year', $selectedYear) ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>

                <!-- Nút Lọc -->
                <div class="col-md-2 d-flex align-items-end mt-2">
                    <button type="submit" class="btn btn-primary">Lọc</button>
                </div>
            </div>
        </form>



        <div class="card">
            <div class="card-header">
                <h4>Hóa Đơn Phạt</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    @if($penalties->isEmpty())
                        <p class="text-center">Không có hóa đơn phạt nào.</p>
                    @else
                    <table id="datatable" class="table table-striped" data-toggle="data-table">
                        <thead>
                        <tr>
                            <th>Nhà</th>
                            <th>Ngày Phạt</th>
                            <th>Số Tiền (VND)</th>
                            <th>Lý Do</th>
                            <th>Trạng Thái</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($penalties as $index => $penalty)
                            <tr>
                                <td>{{$penalty->house->name}}</td>
                                <td>{{ \Carbon\Carbon::parse($penalty->penalty_date)->format('d/m/Y') }}</td>
                                <td>{{ number_format($penalty->amount, 0) }} VND</td>
                                <td>{{ $penalty->description }}</td>
                                <td>
                                     <span class="badge status-badge  {{$penalty->status ==1 ? 'bg-success' : 'bg-danger'}} ">
                                        {{ $penalty->status == 1 ? 'Đã Thanh Toán' : 'Chưa Thanh Toán' }}
                                    </span>
                                  </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>


        <!-- Tổng tiền -->
        @if($totalPenaltyAmount != 0)
        <div class="card mt-4">
            <div class="card-header">
                <h4>Tổng Tiền Phạt</h4>
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
                        <td><strong>Tổng Tiền Phạt</strong></td>
                        <td><strong>{{ number_format($totalPenaltyAmount, 0) }} VND</strong></td>
                    </tr>
                    <tr>
                        <td>Thanh Toán</td>
                        <td>
                            <form action="{{ route('vnpay.pay.penalties') }}" method="POST">
                                @csrf
                                <table>
                                    <tr>
                                        <td><strong>{{ number_format($totalPenaltyAmount, 0) }} VND</strong></td>
                                    </tr>
                                </table>

                                <!-- Order Details -->
                                <input type="hidden" name="order_id" value="{{ uniqid() }}">
                                <input type="hidden" name="amount" value="{{ $totalPenaltyAmount }}">
                                <input type="hidden" name="order_desc" value="Thanh toán đơn hàng tại RoomMate">
                                <input type="hidden" name="language" value="vn">
                                <input type="hidden" name="customer_name" value="{{ Auth::user()->name }}">
                                <input type="hidden" name="customer_email" value="{{ Auth::user()->email }}">
                                <input type="hidden" name="customer_phone" value=" ">
                                <input type="hidden" name="customer_address" value=" ">

                                @foreach($penalties as $penaltie)
                                    <input type="hidden" name="penalties_bill_id[]" value="{{ $penaltie->penalty_id }}">
                                @endforeach




                                <button type="submit" class="btn btn-success">Thanh toán</button>

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

