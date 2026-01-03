@extends('welcome')
@section('title', 'Chỉnh Sửa Thông Tin Người Thuê')

@section('content')
    <style>
        #preview img, #preview_portrait_image img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-right: 10px;
            margin-bottom: 10px;
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Chỉnh Sửa Thông Tin Người Thuê</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('tenant-detail.update', $tenantDetail->tenant_detail_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="area_id" class="form-label">Chọn Phòng</label>
                                <select class="form-control" id="tenant_id" name="tenant_id">
                                    <option value="">-- Chọn Phòng --</option>
                                    @foreach($tenants as $tenant)
                                        <option value="{{ $tenant->tenant_id }}" {{ $tenant->tenant_id == $tenantDetail->tenant_id ? 'selected' : '' }}>
                                            {{ $tenant->house_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Họ Và Tên</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $tenantDetail->full_name }}" required>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" class="form-check-input" id="leader" name="leader" value="1" {{ $tenantDetail->leader ? 'checked' : '' }}>
                                <label class="form-check-label" for="leader">Đại Diện</label>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Số Điện Thoại</label>
                                <input type="number" class="form-control" id="phone" name="phone" value="{{ $tenantDetail->phone }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $tenantDetail->email }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="identity_card" class="form-label">Số CCCD/CMND/PASSPORT</label>
                                <input type="text" class="form-control" id="identity_card" name="identity_card" value="{{ $tenantDetail->identity_card }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="identity_card_image" class="form-label">Hình Mặt Trước/Sau CCCD/CMND/PASSPORT</label>
                                <input type="file" class="form-control" id="identity_card_image" name="identity_card_image[]" multiple>
                            </div>
                            <div id="preview" class="d-flex flex-wrap mt-2">
                                @if($tenantDetail->identity_card_image)
                                    @foreach(json_decode($tenantDetail->identity_card_image) as $image)
                                        <img src="{{ asset($image) }}" alt="Identity Card Image">
                                    @endforeach
                                @endif


                            </div>


                            <div class="mb-3">
                                <label for="portrait_image" class="form-label">Ảnh Chân Dung</label>
                                <input type="file" class="form-control" id="portrait_image" name="portrait_image">
                            </div>
                            <div id="preview_portrait_image" class="d-flex flex-wrap mt-2">
                                @if($tenantDetail->portrait_image)
                                    <img src="{{ asset($tenantDetail->portrait_image) }}" alt="Portrait Image">
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">Giới Tính</label>
                                <select name="gender" id="gender">
                                    <option value="Nam" {{ $tenantDetail->gender === 'Nam' ? 'selected' : '' }}>Nam</option>
                                    <option value="Nữ" {{ $tenantDetail->gender === 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                    <option value="Khác" {{ $tenantDetail->gender === 'Khác' ? 'selected' : '' }}>Khác</option>

                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Ngày Sinh</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $tenantDetail->date_of_birth }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                            <a href="{{ route('tenant-detail.list') }}" class="btn btn-secondary">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('identity_card_image').addEventListener('change', function(event) {
            const preview = document.getElementById('preview');
            preview.innerHTML = '';

            const files = event.target.files;
            if (files) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        preview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            }
        });

        // Hiển thị ảnh đã chọn cho portrait_image
        document.getElementById('portrait_image').addEventListener('change', function(event) {
            const preview = document.getElementById('preview_portrait_image');
            preview.innerHTML = '';  // Xóa nội dung trước đó (nếu có)

            const files = event.target.files;
            if (files && files.length > 0) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    preview.appendChild(img);
                }
                reader.readAsDataURL(files[0]); // Chỉ đọc file đầu tiên
            }
        });
    </script>
@endsection
