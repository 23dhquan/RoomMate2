@extends('welcome')
@section('title', 'Danh Sách Phạt')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Danh Sách Phạt</h4>
                        </div>
                        <a href="{{route('penalty.create')}}" class="text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" title="Thêm khu vực mới">
                            <i class="btn-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </i>
                            <span class="ms-2">Thêm Phiếu Phạt</span>
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Lý Do </th>
                                    <th>Phòng</th>
                                    <th>Số Tiền</th>
                                    <th>Ngày Phạt</th>

                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($penalties as $penalty)
                                    <tr>
                                        <td>{{ $penalty->penalty_id }}</td>
                                        <td>{{ $penalty->description }}</td>
                                        <td>{{$penalty->house_name}}</td>
                                        <td>{{ number_format($penalty->amount, 0, ',', '.') }} VNĐ</td>
                                        <td>{{ \Carbon\Carbon::parse($penalty->penalty_date)->format('d/m/Y H:i') }}</td>


                                        <td class="d-flex align-items-center">
                                            <form action="{{ route('penalty.updateStatus', $penalty->penalty_id) }}" method="POST" class="update-status-form">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-sm {{ $penalty->status == 1 ? 'btn-success' : 'btn-danger' }} update-status-btn"
                                                        {{ $penalty->status == 1 ? 'disabled' : '' }}
                                                        data-id="{{ $penalty->penalty_id }}">
                                                    {{ $penalty->status == 1 ? 'Đã xử lý' : 'Chờ xử lý' }}
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
        document.querySelectorAll('.update-status-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Ngăn chặn việc gửi form ngay lập tức

                const form = this; // Lưu trữ form để sử dụng sau

                // Hiển thị hộp thoại xác nhận với SweetAlert2
                Swal.fire({
                    title: 'Bạn có chắc không?',
                    text: "Bạn sẽ không thể hoàn tác điều này!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, đánh dấu đã xử lý!',
                    width: '32rem',
                    padding: '1rem',
                    scrollbarPadding: false // Ngăn không cho giao diện bị giật khi ẩn thanh cuộn
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gửi form bằng AJAX nếu người dùng xác nhận mà không load lại trang
                        $.ajax({
                            url: form.action, // URL từ thuộc tính action của form
                            method: form.method, // Phương thức từ thuộc tính method của form
                            data: $(form).serialize(), // Serialize dữ liệu form
                            success: function(response) {
                                Swal.fire({
                                    title: 'Cập nhật thành công!',
                                    text: 'Khoản phạt đã được đánh dấu là đã xử lý.',
                                    icon: 'success',
                                    scrollbarPadding: false // Ngăn không cho giao diện bị giật khi ẩn thanh cuộn
                                });

                                // Cập nhật giao diện
                                const button = form.querySelector('.update-status-btn');
                                button.classList.remove('btn-danger');
                                button.classList.add('btn-success');
                                button.innerText = 'Đã xử lý';
                                button.disabled = true; // Vô hiệu hóa nút sau khi đã xử lý
                            },
                            error: function(response) {
                                Swal.fire(
                                    'Lỗi!',
                                    'Đã xảy ra lỗi khi cập nhật trạng thái.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>


    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Ngăn chặn việc gửi form ngay lập tức

                const form = this; // Lưu trữ form để sử dụng sau

                // Hiển thị hộp thoại xác nhận với SweetAlert2
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    width: '32rem',
                    padding: '1rem',
                    scrollbarPadding: false // Ngăn không cho giao diện bị giật khi ẩn thanh cuộn
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gửi form bằng AJAX nếu người dùng xác nhận mà không load lại trang
                        $.ajax({
                            url: form.action,
                            method: form.method,
                            data: $(form).serialize(),
                            // Serialize dữ liệu form
                            success: function(response) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Your file has been deleted.',
                                    icon: 'success',
                                    scrollbarPadding: false // Ngăn không cho giao diện bị giật khi ẩn thanh cuộn
                                });
                                // Xử lý sau khi thành công, có thể là xóa hàng trong bảng
                                $(form).closest('tr').remove(); // Xóa hàng hiện tại
                            },
                            error: function(response) {
                                Swal.fire(
                                    'Error!',
                                    'There was an error deleting the area.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

@endsection
