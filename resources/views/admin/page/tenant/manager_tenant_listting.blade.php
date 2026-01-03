@extends('welcome')
@section('title', 'Danh Sách Phòng Cho Thuê')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Danh Sách Phòng Cho Thuê</h4>
                        </div>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Phòng</th>
                                    <th>Tài Khoản </th>
                                    <th>Người Phụ Trách </th>
                                    <th>Bắt Đầu </th>
                                    <th>Hết Hạn</th>
                                    <th>Thời Gian Còn</th>
                                    <th>Hành Động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tenants as $tenant)
                                    <tr>
                                        <td>{{ $tenant->tenant_id }}</td>
                                        <td>{{ $tenant->house_name }}</td>
                                        <td>{{ $tenant->user_name }}</td>
                                        <td>{{ $tenant->tenant_name }}</td>

                                        <td>{{ \Carbon\Carbon::parse($tenant->start_date)->format('d/m/Y') }}</td>

                                        <td>{{\Carbon\Carbon::parse( $tenant->end_date)->format('d/m/Y') }}</td>

                                        <td>
                                            @if ($tenant->days_remaining >= 0)
                                              Còn  {{ $tenant->days_remaining }} ngày
                                            @else
                                                Đã hết hạn {{ abs($tenant->days_remaining) }}
                                            @endif
                                        </td>

                                        <td>
                                            <form action="{{ route('tenants.destroy', $tenant->tenant_id) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-icon btn-danger" style=" border: none;">
                                                     <span class="btn-inner">
                                                 Dừng Thuê
                                                </span>
                                                </button>
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

    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Ngăn chặn gửi form ngay lập tức

                const form = this; // Lưu form để dùng trong AJAX

                // Hiển thị hộp thoại xác nhận với SweetAlert2
                Swal.fire({
                    title: 'Bạn Chắc Chưa?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, Chấm Dứt!',
                    width: '32rem',
                    padding: '1rem',
                    scrollbarPadding: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gửi form bằng AJAX nếu xác nhận
                        $.ajax({
                            url: form.action,
                            method: form.method,
                            data: $(form).serialize(), // Serialize dữ liệu form
                            success: function(response) {
                                Swal.fire({
                                    title: 'Chấm Dứt!',
                                    text: 'Bạn Đã Chấm Dứt Thuê Thành Công.',
                                    icon: 'success',
                                    scrollbarPadding: false
                                });
                                $(form).closest('tr').remove(); // Xóa hàng hiện tại
                            },
                            error: function (xhr) {
                                // Lấy thông báo lỗi từ server và hiển thị
                                const errorMessage = xhr.responseJSON?.message ||
                                    'There was an error deleting the Tenant.';
                                Swal.fire({
                                    title: 'Còn Trường Hợp Chưa Xử Lý!',
                                    text: errorMessage,
                                    icon: 'error',
                                    scrollbarPadding: false // Ngăn không cho giao diện bị giật khi ẩn thanh cuộn
                                });
                            }

                        });
                    }
                });
            });
        });
    </script>


@endsection
