@extends('welcome')
@section('title', 'Chỉnh Sửa Phiếu Phạt')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Chỉnh Sửa Phiếu Phạt</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('penalty.update', $penalty->penalty_id) }}" method="POST">
                            @csrf
                            @method('PUT')

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
                                <label for="tenant_id" class="form-label">Chọn Người Thuê</label>
                                <select class="form-control" id="tenant_id" name="tenant_id" required>
                                    @foreach($tenants as $tenant)
                                        <option value="{{ $tenant->tenant_id }}"
                                            {{ $penalty->tenant_id == $tenant->tenant_id ? 'selected' : '' }}>
                                            {{ $tenant->house_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Lý Do Phạt</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{ $penalty->description }}" required>
                            </div>

                            <div hidden class="mb-3">
                                <label for="penalty_date" class="form-label">Ngày Phạt</label>
                                <input type="text" class="form-control" id="penalty_date" name="penalty_date" required>
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Số Tiền Phạt</label>
                                <input type="text" class="form-control" id="amount" name="amount" value="{{ $penalty->amount }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <a href="{{ route('penalty.list') }}" class="btn btn-secondary">Quay lại</a>
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
