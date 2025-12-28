@extends('welcome')
@section('title', 'Lịch Sử')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Lịch Sử Thanh Toán</h4>
                        </div>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Số Tiền</th>

                                    <th>Thanh Toán</th>
                                    <th>Thời Gian</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->payment_id }}</td>
                                        <td>{{ $payment->name }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ $payment->note }}</td>

                                        <td>{{ $payment->payment_date }}</td>



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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            if ($.fn.DataTable) {
                const tableSelector = $('[data-toggle="data-table"]'); // Lưu selector vào biến
                if (tableSelector.length) {
                    const table = tableSelector.DataTable({
                        paging: true, // Bật phân trang
                        searching: true, // Bật tìm kiếm
                        ordering: true, // Bật sắp xếp
                        dom: '<"row align-items-center"<"col-md-6" l><"col-md-6" f>><"table-responsive border-bottom my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">',
                    });
                }
            }
        });


    </script>

@endsection
