@extends('welcome')
@section('title', 'Thêm Khu Vực')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Chỉnh Sửa Khu Vực</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('areas.update', $area->area_id) }}" method="POST"> <!-- Chú ý truyền ID -->
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Tên Khu Vực</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $area->name }}" required> <!-- Hiển thị tên cũ -->
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa Chỉ</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ $area->address }}" required> <!-- Hiển thị địa chỉ cũ -->
                            </div>

                            <button type="submit" class="btn btn-primary">Sửa</button>
                            <a href="{{ route('area.list') }}" class="btn btn-secondary">Quay lại</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
