@extends('welcome')
@section('title', 'Danh Sách Nhà')

@section('content')
    <style>
        .swal2-input {
            width: 50%;
            border: 1px solid #ccc;
            border-radius: 5px; /* Thay đổi góc cạnh */
            background-color: #fff; /* Màu nền */
            font-size: 16px; /* Kích thước chữ */
        }

        .swal2-input:focus {
            border-color: #007bff; /* Màu viền khi chọn */
            outline: none; /* Không viền khi chọn */
        }

    </style>
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            @foreach ($houses as $house)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card {{ $house->is_rented == 0 ? 'bg-danger' : 'bg-success' }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <button   onclick="showAddTenantModal({{ $house->house_id }})"   class="bg-white rounded p-3 btn btn-icon">
                                    <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 5v14m7-7H5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>

                                </button>
                                <div class="text-end">
                                    <h4 class="card-title text-white">{{ $house->name }}</h4>
                                    <p class="text-white"><strong>Giá: </strong>{{ number_format($house->price, 0, ',', '.') }} VNĐ</p>
                                    <p class="text-white"><strong>Khu vực: </strong>{{ $house->area_name }}</p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



    <script>
        function showAddTenantModal(houseId) {
            let usersOptions = `
    <option value="" disabled selected>Chọn người dùng</option>


            @foreach($filteredUsers as $user)
            <option value="{{ $user->user_id }}">{{ $user->name }}</option>
        @endforeach
            `;

            Swal.fire({
                title: 'Thêm thông tin người thuê',
                html: `
        <select id="user_id" class="swal2-input">${usersOptions}</select>
        <input type="hidden" id="house_id" value="${houseId}">
        <input type="date" id="start_date" class="swal2-input" placeholder="Ngày bắt đầu">
        <input type="date" id="end_date" class="swal2-input" placeholder="Ngày kết thúc">
        `,
                 confirmButtonText: 'Lưu',
                showCancelButton: true, // Thêm nút hủy
                cancelButtonText: 'Hủy',
                focusConfirm: false,
                scrollbarPadding: false, // Tắt thanh cuộn
                preConfirm: () => {
                    const userId = document.getElementById('user_id').value;
                    const houseId = document.getElementById('house_id').value;
                    const startDate = document.getElementById('start_date').value;
                    const endDate = document.getElementById('end_date').value;

                    if (!userId || !houseId || !startDate) {
                        Swal.showValidationMessage('Vui lòng nhập đầy đủ thông tin!');
                        return false;
                    }

                    return { userId, houseId, startDate, endDate };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const data = result.value;

                    $.ajax({
                        url: '/tenants/store', // Đường dẫn đến API của bạn
                        method: 'POST',
                        data: {
                            user_id: data.userId,
                            house_id: data.houseId,
                            start_date: data.startDate,
                            end_date: data.endDate,
                            _token: '{{ csrf_token() }}' // Gửi mã CSRF
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Thành công!',
                                text: response.message,
                                icon: 'success',
                                scrollbarPadding: false // Tắt thanh cuộn
                            }).then(() => {
                                location.reload(); // Làm mới trang sau khi hiển thị thông báo thành công
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Lỗi!',
                                text: xhr.responseJSON.message || 'Có lỗi xảy ra.',
                                icon: 'error',
                                scrollbarPadding: false // Tắt thanh cuộn
                            });
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Đã hủy!',
                        text: 'Hành động của bạn đã bị hủy.',
                        icon: 'error',
                        scrollbarPadding: false // Tắt thanh cuộn
                    });
                }
            });
        }

    </script>


@endsection
