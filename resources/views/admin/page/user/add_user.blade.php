@extends('welcome')
@section('title', 'Thêm Tài Khoản')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm Tài Khoản Mới</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST"> <!-- Đường dẫn đến route lưu khu vực -->
                            @csrf <!-- Thêm token bảo mật -->

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <div>
                                        @foreach ($errors->all() as $error)
                                            <span>{{ $error }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên Tài Khoản</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Số Điện Thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa Chỉ Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Mật Khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Nhập Lại Mật Khẩu</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Ghi Chú</label>
                                <input type="text" class="form-control" id="note" name="note" >
                            </div>
                            <div class="form-group">
                                <label for="role">Vai Trò</label>
                                <select name="role" id="role" class="form-control">
                                    @if(auth()->check() && auth()->user()->role === 'admin' && auth()->user()->is_super_admin ===1)
                                        <!-- Nếu người dùng là admin và area_id = 0, hiển thị cả hai tùy chọn -->
                                        <option value="tenant">Tenant</option>
                                        <option value="admin">Admin</option>
                                    @else
                                        <!-- Nếu không, chỉ hiển thị tùy chọn Tenant -->
                                        <option value="tenant">Tenant</option>
                                    @endif
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="area_id" class="form-label">Chọn Khu Vực</label>
                                <select class="form-control" id="area_id" name="area_id" >
                                    @foreach($areas as $area)
                                        <option  value="{{ $area->area_id }}">{{ $area->name }}</option> <!-- Hiển thị ID và tên của khu vực -->
                                    @endforeach
                                </select>
                            </div>


                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <a href="{{ route('user.list') }}" class="btn btn-secondary">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
