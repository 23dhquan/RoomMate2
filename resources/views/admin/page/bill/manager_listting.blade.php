@extends('welcome')
@section('title', 'Thêm Tiền Điện')

@section('content')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Danh Sách Thuê Nhà</h4>
                        </div>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tài Khoản</th>
                                    <th>Phòng</th>
                                    <th>Thời Gian</th>
                                    <th>Hành Động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tenants as $tenant)
                                    <tr>
                                        <td>{{ $tenant->tenant_id }}</td>
                                        <td>{{$tenant->user_name}}</td>
                                        <td>{{$tenant->house_name}}</td>
                                        <td><div class="text-info"> {{$tenant->bill_water_date}}</div></td>
                                        <td> <a href="{{ route('bill.create', ['house_id' => $tenant->house_id]) }}" class="btn btn-primary btn-sm">
                                                Thêm Hóa Đơn
                                            </a>
                                        </td>





                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
