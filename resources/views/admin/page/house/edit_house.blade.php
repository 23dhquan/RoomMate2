@extends('welcome')
@section('title', 'Chỉnh Sửa Phòng Thuê')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Chỉnh Sửa Phòng Thuê</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('house.update', $house->house_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Thêm phương thức PUT -->

                            <div class="d-flex">
                                <!-- Phần bên trái: Thông tin phòng -->
                                <div class="w-50 pe-3">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Mã Số Phòng</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $house->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Giá Tiền</label>
                                        <input type="text" class="form-control" id="price" name="price" value="{{ $house->price }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Mô Tả</label>

                                        <textarea type="text" class="form-control" id="description" name="description" required> {{ $house->description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="area_id" class="form-label">Chọn Khu Vực</label>
                                        <select class="form-control" id="area_id" name="area_id">
                                            @foreach($areas as $area)
                                                <option value="{{ $area->area_id }}" {{ $house->area_id == $area->area_id ? 'selected' : '' }}>{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Phần bên phải: Upload ảnh -->
                                <div class="w-50 ps-3">
                                    <div class="mb-3">
                                        <label for="images" class="form-label">Chọn Ảnh Mới</label>
                                        <input type="file" class="form-control" id="images" name="images[]" multiple>
                                        <small class="text-muted">Có thể chọn nhiều ảnh.</small>
                                    </div>

                                    <div id="preview" class="mt-3 d-flex flex-wrap gap-2">
                                        <!-- Hiển thị ảnh hiện tại -->
                                        @foreach($images as $image)
                                            <div class="position-relative">
                                                <img src="{{ asset( $image->image_path) }}" alt="House Image" style="width: 100px; height: 100px; object-fit: cover;" class="rounded">

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Cập Nhật</button>
                            <a href="{{ route('house.list') }}" class="btn btn-secondary mt-3">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Xử lý xem trước ảnh được chọn
        document.getElementById('images').addEventListener('change', function(event) {
            const preview = document.getElementById('preview');
            const existingImages = preview.querySelectorAll('img'); // Lưu trữ các ảnh đã có

            // Ẩn các ảnh hiện tại
            existingImages.forEach(img => {
                img.style.display = 'none';
            });

            // Thêm ảnh mới vào phần xem trước
            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    img.classList.add('rounded'); // Tạo góc bo tròn
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>

@endsection
