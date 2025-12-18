@extends('welcome')
@section('title', 'Đăng Ký Dịch Vụ')

@section('content')
    <div class="container-fluid content-inner mt-5 py-0" style="margin-top: 40px !important;">
        <h2 class="text-center">Đăng Ký Dịch Vụ</h2>

        <div class="card mt-4">
            <div class="card-header">
                <h4>Thông Tin Đăng Ký</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('register.service') }}" method="POST">
                    @csrf

                    <!-- Chọn Dịch Vụ -->
                    <div class="form-group">
                        <label for="service_id">Chọn Dịch Vụ:</label>
                        <select name="service_id" id="service_id" class="form-control">
                            @foreach ($services as $service)
                                <option value="{{ $service->service_id }}">
                                    {{ $service->name }} - {{ number_format($service->price) }} VND
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Ghi chú -->
                    <div class="form-group mt-3">
                        <label for="description">Ghi Chú:</label>
                        <textarea name="description" id="description" class="form-control" rows="3"
                                  placeholder="Nhập ghi chú (Ngày, Giờ)..."></textarea>
                    </div>

                    <!-- Nút Gửi -->
                    <div class="form-group mt-4 text-center">
                        <button type="submit" class="btn btn-primary">Đăng Ký Dịch Vụ</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Danh sách dịch vụ đã đăng ký -->
        <div class="card mt-4">
            <div class="card-header">
                <h4>Dịch Vụ Đã Đăng Ký</h4>
                <p>*Thanh toán để xác nhận dịch vụ</p>
            </div>
            <div class="card-body">
                @if ($registeredServices->isEmpty())
                    <p class="text-center">Bạn chưa đăng ký dịch vụ nào. </p>


                @else
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Dịch Vụ</th>
                                <th>Ghi Chú</th>
                                <th>Giá Tiền</th>
                                <th>Trạng Thái</th>
                                <th>Thanh Toán</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($registeredServices as $service)
                                <tr>
                                    <td>{{ $service->service_name }}</td>

                                    <td>{{ $service->description }}</td>
                                    <td>{{ number_format( $service->service_price)}} VNĐ </td>

                                    <td>
                                        <span class="badge {{ $service->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $service->status == '1' ? 'Xác Nhận' : 'Chờ Xác Nhận' }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('vnpay.pay.service') }}" method="POST">
                                            @csrf


                                            <!-- Order Details -->
                                            <input type="hidden" name="order_id" value="{{ uniqid() }}">
                                            <input type="hidden" name="amount" value="{{ $service->service_price }}">
                                            <input type="hidden" name="order_desc" value="Thanh toán đơn hàng tại RoomMate">
                                            <input type="hidden" name="language" value="vn">
                                            <input type="hidden" name="customer_name" value="{{ Auth::user()->name }}">
                                            <input type="hidden" name="customer_email" value="{{ Auth::user()->email }}">
                                            <input type="hidden" name="customer_phone" value=" ">
                                            <input type="hidden" name="customer_address" value=" ">
                                            <input type="hidden" name="service_bill_id" value="{{ $service->house_service_id}}">

                                            <button type="submit" class="btn btn-sm btn-success update-status-btn"
                                                    {{ $service->status == 1 ? 'disabled' : '' }}
                                                   >
                                                {{ $service->status == 1 ? 'Đã Thanh Toán' : 'Thanh Toán' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
