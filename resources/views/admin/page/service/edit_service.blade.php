@extends('welcome')
@section('title', 'Chỉnh Sửa Dịch Vụ')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Chỉnh Sửa Dịch Vụ</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('service.update',$service->service_id) }}" method="POST"> <!-- Đường dẫn đến route lưu Dịch Vụ -->
                            @csrf <!-- Thêm token bảo mật -->
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên Dịch Vụ</label>
                                <input value="{{ $service->name }}" type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Giá Tiền</label>
                                <input value="{{ $service->price }}" type="text" class="form-control" id="price" name="price" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Sửa</button>
                            <a href="{{ route('service.list') }}" class="btn btn-secondary">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
