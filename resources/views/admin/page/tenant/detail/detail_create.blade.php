@extends('welcome')
@section('title', 'Thêm Người Thuê')

@section('content')
    <style>
        #preview img {
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
        #preview_portrait_image img {
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
                        <h4 class="card-title">Thêm Người Thuê Mới</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('tenant-detail.store') }}" method="POST" enctype="multipart/form-data"> <!-- Đường dẫn đến route lưu khu vực -->
                            @csrf <!-- Thêm token bảo mật -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="area_id" class="form-label">Chọn Phòng</label>
                                <select class="form-control" id="tenant_id" name="tenant_id" >
                                    <option value="">-- Chọn Phòng --</option>
                                    @foreach($tenants as $tenant)
                                        <option  value="{{ $tenant->tenant_id }}">{{ $tenant->house_name }}</option> <!-- Hiển thị ID và tên của khu vực -->
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Họ Và Tên</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" class="form-check-input" id="leader" name="leader" value="1">
                                <label class="form-check-label" for="leader">Đại Diện</label>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Số Điện Thoại</label>
                                <input type="number" class="form-control" id="phone" name="phone" required>
                            </div> <div class="mb-3">
                                <label for="name" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Số CCCD/CMND/PASSPORT</label>
                                <input type="text" class="form-control" id="identity_card" name="identity_card" required>
                            </div>
                            <div class="mb-3">
                                <label for="identity_card_image" class="form-label">Hình Mặt Trước/Sau CCCD/CMND/PASSPORT</label>
                                <input type="file" class="form-control" id="identity_card_image" name="identity_card_image[]" multiple required>
                            </div>
                            <div id="preview" class="d-flex flex-wrap mt-2"></div>


                            <div class="mb-3">
                                <label for="portrait_image" class="form-label">Ảnh Chân Dung</label>
                                <input type="file" class="form-control" id="portrait_image" name="portrait_image"  required>
                            </div>
                            <div id="preview_portrait_image" class="d-flex flex-wrap mt-2"></div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Giới Tính</label>
                                <select name="gender" id="gender">
                                    <option value="female">Nam</option>
                                    <option value="male">Nữ</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Ngày Sinh</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <a href="{{ route('tenant-detail.list') }}" class="btn btn-secondary">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('identity_card_image').addEventListener('change', function(event) {
            let preview = document.getElementById('preview');
            preview.innerHTML = '';  // Xóa nội dung trước đó (nếu có)

            let files = event.target.files;
            if (files) {
                Array.from(files).forEach(file => {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let img = document.createElement('img');
                        img.src = e.target.result;
                        preview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            }
        });
        document.getElementById('portrait_image').addEventListener('change', function(event) {
            let preview = document.getElementById('preview_portrait_image');
            preview.innerHTML = '';  // Xóa nội dung trước đó (nếu có)

            let files = event.target.files;
            if (files) {
                Array.from(files).forEach(file => {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let img = document.createElement('img');
                        img.src = e.target.result;
                        preview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            }
        });

    </script>
@endsection
