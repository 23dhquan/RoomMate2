@extends('welcome')
@section('title', 'Thêm Tiền Cọc Nhà')

@section('content')
    <div class="container-fluid content-inner mt-n5 py-0">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thêm Phiếu Cọc</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('deposit.store') }}" method="POST"> <!-- Đường dẫn đến route lưu khu vực -->
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <div>
                                        @foreach ($errors->all() as $error)
                                            <span>{{ $error }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <select class="form-control" id="tenant_detail_id" name="tenant_detail_id">

                                <option>----- Người Đặt Cọc -----</option>
                                @foreach($filteredTenants as $tenant)
                                    <option value="{{ $tenant->tenant_detail_id }}" data-house-id="{{ $tenant->house_id }}">
                                        {{ $tenant->tenant_user }}
                                    </option>
                                @endforeach
                            </select>

                            <input type="hidden" id="house_id" name="house_id"> <!-- Input ẩn lưu house_id -->

                            <div class="mb-3">
                                <label for="house_id" class="form-label">Tên Nhà/Phòng</label>
                                <input type="text" class="form-control" id="house_name"  readonly>
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Số Tiền Cọc</label>
                                <input type="number" class="form-control" id="amount" name="amount" value="3000000" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="deposit_date" class="form-label">Ngày Nhận Cọc</label>
                                <input type="date"  class="form-control" id="deposit_date" name="deposit_date"   required>


                            </div>

                            <button type="submit" class="btn btn-primary">Thêm</button>
                            <a href="{{ route('area.list') }}" class="btn btn-secondary">Quay lại</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        const tenantSelect = document.getElementById('tenant_detail_id');
        const houseNameInput = document.getElementById('house_name');
        const houseIdInput = document.getElementById('house_id'); // Input ẩn để lưu house_id

        tenantSelect.addEventListener('change', async () => {
            const selectedOption = tenantSelect.selectedOptions[0];
            const houseId = selectedOption.dataset.houseId; // Lấy house_id từ data-house-id
            const houseName = await fetchHouseName(houseId); // Lấy house_name từ API

            houseNameInput.value = houseName; // Hiển thị house_name trong input
            houseIdInput.value = houseId; // Lưu house_id vào input ẩn
        });

        const fetchHouseName = async (houseId) => {
            const res = await fetch(`/get-house-name/${houseId}`);
            const data = await res.json();
            return data.name || 'Không tìm thấy tên';
        };

    </script>
@endsection
