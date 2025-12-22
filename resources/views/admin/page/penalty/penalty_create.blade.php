@extends('welcome')
@section('title', 'Thêm Phiếu Phạt')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm Phiếu Phạt Mới</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('penalty.store') }}" method="POST"> <!-- Đường dẫn đến route lưu Phiếu Phạt -->
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <div>
                                        @foreach ($errors->all() as $error)
                                            <span>{{ $error }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="area_id" class="form-label">Chọn Phòng</label>
                                <select class="form-control" id="house_id" name="house_id" >
                                    @foreach($tenants as $tenant)
                                        <option  value="{{ $tenant->house_id }}">{{ $tenant->house_name }}</option> <!-- Hiển thị ID và tên của khu vực -->
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Lý Do Phạt</label>
                                <input type="text" class="form-control" id="description" name="description" required>
                            </div>
                            <div hidden class="mb-3">
                                <label for="penalty_date" class="form-label">Penalty Date</label>
                                <input type="text" class="form-control" id="penalty_date" name="penalty_date" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Số Tiền Phạt</label>
                                <input type="text" class="form-control" id="amount" name="amount" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <a href="{{ route('area.list') }}" class="btn btn-secondary">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Lấy ngày giờ hiện tại
        document.addEventListener('DOMContentLoaded', function () {
            const penaltyDateInput = document.getElementById('penalty_date');

            // Định dạng ngày giờ thành: YYYY-MM-DD HH:mm:ss
            const now = new Date();
            const formattedDate = now.getFullYear() + "-" +
                String(now.getMonth() + 1).padStart(2, '0') + "-" +
                String(now.getDate()).padStart(2, '0') + " " +
                String(now.getHours()).padStart(2, '0') + ":" +
                String(now.getMinutes()).padStart(2, '0') + ":" +
                String(now.getSeconds()).padStart(2, '0');

            // Gán giá trị ngày giờ vào ô input
            penaltyDateInput.value = formattedDate;
        });
    </script>
@endsection
