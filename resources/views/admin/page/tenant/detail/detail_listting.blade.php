@extends('welcome')
@section('title', 'Danh Sách Người Thuê')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Danh Sách Người Thuê</h4>
                        </div>
                        <a href="{{route('tenant-detail.create')}}" class="text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" title="Thêm khu vực mới">
                            <i class="btn-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </i>
                            <span class="ms-2">Thêm Người Thuê</span>
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Phòng</th>
                                    <th>Hành Động</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tenantDetails as $tenantDetail)
                                    <tr>
                                        <td>{{ $tenantDetail->tenant_detail_id }}</td>
                                        <td>{{ $tenantDetail->full_name }} <span style="color: red"  >
                                                    {{ $tenantDetail->leader == 1 ? '*' : '' }}
                                                </span></td>
                                        <td>{{ $tenantDetail->email }}</td>
                                        <td>{{ $tenantDetail->phone }}</td>
                                        <td> {{$tenantDetail->house_name_teantDetail }}</td>




                                        <td class="d-flex align-items-center">
                                            <a href="{{ route('tenant-detail.edit', $tenantDetail->tenant_detail_id) }}" class="btn btn-sm btn-icon btn-warning me-2 mr-2">
                                                    <span class="btn-inner">
                                                       <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                          <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                          <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       </svg>
                                                    </span>
                                            </a>

                                            <form action="{{ route('tenant-detail.destroy', $tenantDetail->tenant_detail_id) }}" method="POST" class="delete-form me-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-icon btn-danger" style=" border: none;">
                                                         <span class="btn-inner">
                                                       <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                          <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                          <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                          <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       </svg>
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
    <script>
        document.querySelectorAll('.btn-reset-password').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');

                // Hiển thị hộp thoại nhập mật khẩu mới
                Swal.fire({
                    title: 'Nhập mật khẩu mới',
                    input: 'password',
                    inputAttributes: {
                        autocapitalize: 'off',
                        placeholder: 'Mật khẩu mới'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Cập nhật',
                    cancelButtonText: 'Hủy',
                    preConfirm: (newPassword) => {
                        if (!newPassword) {
                            Swal.showValidationMessage('Vui lòng nhập mật khẩu mới.');
                        }
                        return newPassword;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route("reset.password") }}',
                            method: 'POST',
                            data: {
                                new_password: result.value,
                                user_id: userId, // Gửi user_id nếu cần
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire('Thành công!', response.message, 'success');
                            },
                            error: function(xhr) {
                                Swal.fire('Lỗi!', xhr.responseJSON.message || 'Có lỗi xảy ra.', 'error');
                            }
                        });
                    }
                });
            });
        });

    </script>
    <script>
        document.querySelectorAll('.toggle-status-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Ngăn chặn việc gửi form ngay lập tức

                const userId = this.id.split('-')[2]; // Lấy ID từ id của form
                const status = this.querySelector('input[name="status"]').value;
                const message = status == 1 ? "Đã mở tài khoản" : "Đã khóa tài khoản"; // Tạo thông báo tương ứng

                // Hiển thị hộp thoại xác nhận với SweetAlert2
                Swal.fire({
                    title: 'Xác nhận',
                    text: message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy',
                    width: '32rem',
                    padding: '1rem',
                    scrollbarPadding: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: this.action, // URL của form
                            method: 'POST',
                            data: $(this).serialize(), // Dữ liệu từ form
                            success: function(response) {

                                Swal.fire({
                                    title: 'Đã Thực Hiện!',
                                    icon: 'success',
                                    scrollbarPadding: false // Ngăn không cho giao diện bị giật khi ẩn thanh cuộn
                                });
                                window.location.href = '/user-list';

                            },

                            error: function(response) {
                                Swal.fire(
                                    'Lỗi!',
                                    'Có lỗi xảy ra khi thay đổi trạng thái.',
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
