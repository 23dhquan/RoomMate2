@extends('welcome')
@section('title', 'Danh Sách Dịch Vụ')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Danh Sách Dịch Vụ</h4>
                        </div>
                        <a href="{{ route('service.create') }}" class="text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" title="Thêm Dịch Vụ mới">
                            <i class="btn-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </i>
                            <span class="ms-2">Thêm Dịch Vụ</span>
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Giá</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{ $service->service_id }}</td>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ number_format($service->price, 0, ',', '.') }} VNĐ</td>

                                        <td class="d-flex align-items-center">
                                            <a href="{{ route('service.edit', $service->service_id) }}" class="btn btn-sm btn-icon btn-warning me-2 mr-2">
                                                <span class="btn-inner">
                                                   <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                      <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                      <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                      <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                   </svg>
                                                </span>
                                            </a>

                                            <form action="{{ route('service.destroy', $service->service_id) }}" method="POST" class="delete-form">
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

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Xác Nhận</h4>
                        </div>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Giá</th>
                                    <th>Trạng Thái</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($houseServices as $houseService)
                                    <tr>
                                        <td>{{ $houseService->house_service_id }}</td>
                                        <td>{{ $houseService->service_name }}</td>
                                        <td>{{ number_format($service->price, 0, ',', '.') }} VNĐ</td>
                                        <td>
                                            <span class="badge {{ $houseService->status == '1' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $houseService->status == '1' ? 'Xác Nhận' : 'Chờ Xác Nhận' }}
                                            </span>
                                        </td>


                                        <td class="d-flex align-items-center">


                                            <form action="{{ route('service.status', $houseService->house_service_id) }}" method="POST" >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-success update-status-btn"
                                                    {{ $houseService->status == 1 ? 'disabled' : '' }}
                                                >
                                                    {{ $houseService->status == 1 ? 'Đã Xác Nhận' : 'Xác Nhận' }}
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

@endsection
