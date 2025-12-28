@extends('welcome')
@section('title', 'Thêm Phòng Thuê')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm Phòng Thuê Mới</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('house.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf <!-- Thêm token bảo mật -->

                            <div class="d-flex">
                                <!-- Phần bên trái: Thông tin phòng -->
                                <div class="w-50 pe-3">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Mã Số Phòng</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Giá Tiền</label>
                                        <input type="text" class="form-control" id="price" name="price" required>
                                    </div>
{{--                                    <div class="mb-3">--}}
{{--                                        <label for="description" class="form-label">Mô Tả</label>--}}
{{--                                        <textarea class="form-control"   id="description" name="description" required></textarea>--}}
{{--                                    </div>--}}
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Mô Tả</label>
                                        <textarea class="form-control"     name="description" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="area_id" class="form-label">Chọn Khu Vực</label>
                                        <select class="form-control" id="area_id" name="area_id">
                                            @foreach($areas as $area)
                                                <option value="{{ $area->area_id }}">{{ $area->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Phần bên phải: Upload ảnh -->
                                <div class="w-50 ps-3">
                                    <div class="mb-3">
                                        <label for="images" class="form-label">Chọn Ảnh Phòng</label>
                                        <input type="file" class="form-control" id="images" name="images[]" multiple required>
                                        <small class="text-muted">Có thể chọn nhiều ảnh.</small>
                                    </div>
                                    <div id="preview" class="mt-3 d-flex flex-wrap gap-2"></div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Thêm</button>
                            <a href="{{ route('area.list') }}" class="btn btn-secondary mt-3">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>--}}

{{--    <!-- Kích hoạt CKEditor -->--}}
{{--    <script>--}}
{{--        CKEDITOR.replace('description');--}}
{{--    </script>--}}


    <script>
        // Xử lý xem trước ảnh được chọn
        document.getElementById('images').addEventListener('change', function(event) {
            const preview = document.getElementById('preview');
            preview.innerHTML = ''; // Xóa nội dung trước đó

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
