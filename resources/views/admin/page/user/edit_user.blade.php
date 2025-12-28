@extends('welcome')
@section('title', 'Chỉnh Sửa Tài Khoản')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Chỉnh Sửa Tài Khoản</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('users.update', $users->user_id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Cần khai báo PUT để gửi yêu cầu cập nhật -->

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
                                <label for="name" class="form-label">Tên Tài Khoản</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ old('name', $users->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Số Điện Thoại</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                       value="{{ old('phone', $users->phone) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Địa Chỉ Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{ old('email', $users->email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="note" class="form-label">Ghi Chú</label>
                                <input type="text" class="form-control" id="note" name="note"
                                       value="{{ old('note', $users->note) }}" >
                            </div>

                            <div class="form-group">
                                <label for="role">Vai Trò</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="tenant" {{ $users->role == 'tenant' ? 'selected' : '' }}>Tenant</option>
                                    <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="area_id" class="form-label">Chọn Khu Vực</label>
                                <select class="form-control" id="area_id" name="area_id">
                                    @foreach($areas as $area)
                                        <option value="{{ $area->area_id }}"
                                            {{ old('area_id', $users->area_id) == $area->area_id ? 'selected' : '' }}>
                                            {{ $area->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Mật Khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" >
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Nhập Lại Mật Khẩu</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" >
                            </div>

                            <button type="submit" class="btn btn-primary">Cập Nhật</button>
                            <a href="{{ route('user.list') }}" class="btn btn-secondary">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
