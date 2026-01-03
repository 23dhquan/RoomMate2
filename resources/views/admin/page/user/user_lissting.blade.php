    @extends('welcome')
    @section('title', 'Tài Khoản')

    @section('content')
        <div class="container-fluid content-inner mt-n5 py-0">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Danh sách tài khoản</h4>
                            </div>
                            <a href="{{route('users.create')}}" class="text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" title="Thêm khu vực mới">
                                <i class="btn-inner">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </i>
                                <span class="ms-2">Thêm Tài Khoản</span>
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
                                        <th>Vai Trò</th>
                                        <th>Note</th>
                                        <th>Trạng Thái</th>

                                        <th>Hành Động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($user as $users)
                                        <tr>
                                            <td>{{ $users->user_id }}</td>

                                            <td>{{ $users->name }}</td>
                                            <td>{{ $users->email }}</td>
                                            <td>{{ $users->note }}</td>
                                            <th>{{strtoupper($users->role)}}</th>
                                            <td>
                                                <span class="badge status-badge {{ $users->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $users->status == 1 ? 'Mở' : 'Đóng' }}
                                                </span>
                                            </td>
                                            <td class="d-flex align-items-center">
                                                <a href="{{ route('users.edit', $users->user_id) }}" class="btn btn-sm btn-icon btn-warning me-2 mr-2">
                                                    <span class="btn-inner">
                                                       <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                          <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                          <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                       </svg>
                                                    </span>
                                                </a>

                                                <form action="{{ route('users.destroy', $users->user_id) }}" method="POST" class="delete-form me-2">
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



                                                <form action="{{ route('users.toggleStatus', $users->user_id) }}" method="POST" class="toggle-status-form" id="toggle-status-{{ $users->user_id }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="{{ $users->status ? 0 : 1 }}">
                                                    <button type="submit" class="btn btn-sm btn-icon {{ $users->status ? 'btn-success' : 'btn-danger' }}" style="border: none;">
                                                        <svg style="width: 20px !important; height: 20px !important;" class="icon-32" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16.4242 5.56204C15.8072 3.78004 14.1142 2.50004 12.1222 2.50004C9.60925 2.49004 7.56325 4.51804 7.55225 7.03104V7.05104V9.19804" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.933 21.0005H8.292C6.198 21.0005 4.5 19.3025 4.5 17.2075V12.9195C4.5 10.8245 6.198 9.12646 8.292 9.12646H15.933C18.027 9.12646 19.725 10.8245 19.725 12.9195V17.2075C19.725 19.3025 18.027 21.0005 15.933 21.0005Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M12.1128 13.9526V16.1746" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function () {
                if ($.fn.DataTable) {
                    const tableSelector = $('[data-toggle="data-table"]'); // Lưu selector vào biến
                    if (tableSelector.length) {
                        const table = tableSelector.DataTable({
                            paging: true, // Bật phân trang
                            searching: true, // Bật tìm kiếm
                            ordering: true, // Bật sắp xếp
                            dom: '<"row align-items-center"<"col-md-6" l><"col-md-6" f>><"table-responsive border-bottom my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">',
                        });
                    }
                }
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
