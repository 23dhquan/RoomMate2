@extends('welcome')
@section('title', 'Danh Sách Hóa Đơn')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Danh Sách Hóa Đơn Nước và Điện</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th>Phòng</th>
                                    <th>Ngày Hóa Đơn</th>
                                    <th>Số Điện/Nước</th>
                                    <th>Số Tiền</th>
                                    <th>Trạng Thái</th>
                                    <th>Hành Động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($waterBills as $waterBill)
                                    <tr>
                                        <td class="text-primary">Tiền Nước</td>
                                        <td>{{ $waterBill->house_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($waterBill->billing_date)->format('d/m/Y') }}</td>
                                        <td>{{ $waterBill->water_reading }}</td>

                                        <td>{{ number_format($waterBill->amount, 0) }} VND</td>
                                        <td>
                                           <span class="badge status-badge {{ $waterBill->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $waterBill->status == 1 ? 'Đã Thanh Toán' : 'Chưa Thánh Toán' }}
                                                </span>
                                        </td>
                                        <td>

                                                <form action="{{ route('bill.updateStatus') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="bill_type" value="water">
                                                    <input type="hidden" name="bill_id" value="{{ $waterBill->water_bill_id }}">
                                                    <button type="submit"  @if($waterBill->status ==1) disabled @endif  class="btn btn-sm update-status-btn btn-success">Nhận Tiền Mặt</button>
                                                </form>

                                        </td>

                                    </tr>
                                @endforeach

                                @foreach ($electricityBills as $electricityBill)
                                    <tr>
                                        <td style="color: #78780e">Tiền Điện</td>

                                        <td>{{ $electricityBill->house_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($electricityBill->billing_date)->format('d/m/Y') }}</td>
                                        <td>{{ $electricityBill->electricity_reading }}</td>

                                        <td>{{ number_format($electricityBill->amount, 0) }} VND</td>
                                        <td>
                                           <span class="badge status-badge {{ $electricityBill->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $electricityBill->status == 1 ? 'Đã Thanh Toán' : 'Chưa Thánh Toán' }}
                                           </span>
                                        </td>
                                        <td>

                                                <form action="{{ route('bill.updateStatus') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="bill_type" value="electricity">
                                                    <input type="hidden" name="bill_id" value="{{ $electricityBill->electricity_bill_id }}">
                                                    <button type="submit" @if($electricityBill->status ==1) disabled @endif class="btn btn-sm update-status-btn btn-success">Nhận Tiền Mặt</button>
                                                </form>

                                        </td>
                                    </tr>
                                @endforeach

                                @foreach ($houseBills as $houseBill)
                                    <tr>
                                        <td style="color: green">Tiền Nhà</td>

                                        <td>{{ $houseBill->house_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($houseBill->billing_date)->format('d/m/Y') }}</td>
                                        <td></td>
                                        <td>{{ number_format($houseBill->amount, 0) }} VND</td>
                                        <td>
                                           <span class="badge status-badge {{ $houseBill->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $houseBill->status == 1 ? 'Đã Thanh Toán' : 'Chưa Thánh Toán' }}
                                           </span>
                                        </td>
                                        <td>

                                            <form action="{{ route('bill.updateStatus') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="bill_type" value="house">
                                                <input type="hidden" name="bill_id" value="{{ $houseBill->house_bill_id }}">
                                                <button type="submit" @if($houseBill->status ==1) disabled @endif class="btn btn-sm update-status-btn btn-success">Nhận Tiền Mặt</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
