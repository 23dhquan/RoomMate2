@extends('welcome')
@section('title', 'Thêm Khu Vực')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm Khu Vực Mới</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('areas.store') }}" method="POST"> <!-- Đường dẫn đến route lưu khu vực -->
                            @csrf <!-- Thêm token bảo mật -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên Khu Vực</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa Chỉ</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <a href="{{ route('area.list') }}" class="btn btn-secondary">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
