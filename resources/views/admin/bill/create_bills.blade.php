@extends('welcome')
@section('title', 'Thêm Tài Khoản')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm Tài Số Điện & Nước</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('bill.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="house_id" value="{{ $selectedHouseId }}">


                            <div class="mb-3">
                                <label for="billing_date" class="form-label">Ngày Hóa Đơn</label>
                                <input type="date" name="billing_date" id="billing_date" class="form-control" required>
                            </div>


                            <div class="mb-3">
                                <label for="electricity_amount" class="form-label">Số Điện</label>
                                <input type="number" name="electricity_reading" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="electricity_image" class="form-label">Ảnh Hóa Đơn Điện (tùy chọn)</label>
                                <input type="file" name="electricity_image" class="form-control" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label for="water_amount" class="form-label">Số Nước</label>
                                <input type="number" name="water_reading" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="water_image" class="form-label">Ảnh Hóa Đơn Nước (tùy chọn)</label>
                                <input type="file" name="water_image" class="form-control" accept="image/*">
                            </div>


                            <button type="submit" class="btn btn-primary">Thêm Hóa Đơn</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Lấy ngày hiện tại
        var currentDate = new Date();

        // Chuyển đổi thành định dạng yyyy-mm-dd
        var year = currentDate.getFullYear();
        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Tháng từ 0-11, cần cộng thêm 1 và đảm bảo 2 chữ số
        var day = currentDate.getDate().toString().padStart(2, '0');

        var formattedDate = year + '-' + month + '-' + day;

        // Gán giá trị vào input
        document.getElementById('billing_date').value = formattedDate;
    </script>

@endsection
