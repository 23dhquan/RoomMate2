<?php

namespace App\Http\Controllers\Admin;

use App\Models\Deposit;
use App\Models\ElectricityBill;
use App\Models\House;
use App\Models\HouseBill;
use App\Models\Penalty;
use App\Models\Tenant;
use App\Models\TenantDetail;
use App\Models\User;
use App\Models\WaterBill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class TenantController extends Controller
{

    public function index()
    {

            $curentArea = auth()->user();
        if ($curentArea->is_super_admin === 1) {
            $tenants = Tenant::where('is_delete', 0)->get();
        } else {
            $tenants = Tenant::whereHas('house', function ($query) use ($curentArea) {
                $query->where('area_id', $curentArea->area_id);
            })->where('is_delete', 0)->get();
        }

        foreach ($tenants as $tenant) {
            $house = House::find($tenant->house_id);
            $tenant->house_name = $house ? $house->name : 'Không có nhà';
            $user = User::find($tenant->user_id);
            $tenant->user_name = $user->name;
            $tenantDetail = TenantDetail::where('tenant_id', $tenant->tenant_id)
                ->where('leader', 1)
                ->first();
            if($tenantDetail){
                $tenant->tenant_name=$tenantDetail->full_name;
            }else{
                $tenant->tenant_name = 'Không tìm thấy tên';
            }

            $startDate = Carbon::parse($tenant->start_date);
            $endDate = Carbon::parse($tenant->end_date);
            $tenant->days_remaining = floor(Carbon::now()->diffInDays($endDate, false));
        }

        return view('admin.page.tenant.manager_tenant_listting', compact('tenants'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'house_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',

        ]);

        // Lưu thông tin người thuê
        Tenant::create([
            'user_id' => $request->user_id,
            'house_id' => $request->house_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_delete' => 0
        ]);

        return response()->json(['message' => 'Thông tin người thuê đã được thêm thành công!'], 200);
    }
    public function destroy($tenant_id)
    {
        $tenant = Tenant::find($tenant_id);

        if (!$tenant) {
            return response()->json(['success' => false, 'message' => 'Tenant not found'], 404);
        }

        $house_id = $tenant->house_id;
        $hasUnresolvedPenalty = Penalty::where('house_id', $house_id)
            ->where('status', 0)
            ->exists();

        if ($hasUnresolvedPenalty) {
            return response()->json(['success' => false, 'message' => 'Còn Phếu Phạt Chưa Xử Lý'], 400);
        }
        $hasDeposit = Deposit::where('house_id', $house_id)
            -> where('status', 0)
            ->exists();
        if($hasDeposit){
            return  response()->json(['success' => false,'message' =>'Chưa Hoàn Tiền Cọc'], 400);
        }
        $haswaterBill = WaterBill::where('house_id', $house_id)->where('status', 0)->exists();
        if($haswaterBill){
            return  response()->json(['success' => false,'message' => 'Chưa Thanh Toán Hóa Đơn Tiền Nước'], 400);
        }
        $hasElectricity  = ElectricityBill::where('house_id', $house_id)->where('status', 0)->exists();
        if($hasElectricity){
            return  response()->json(['success' => false,'message' => 'Chưa Thanh Toán Hóa Đơn Tiền Điện'], 400);
        }
        $hasHouseBill = HouseBill::where('house_id', $house_id)->where('status', 0)->exists();
        if ($hasHouseBill) {
            return  response()->json(['success' => false,'message' => 'Chưa Thanh Toán Hóa Đơn Tiền Nhà'], 400);

        }

        $tenant->is_delete = 1;
        $tenant->save();

        return response()->json(['success' => true, 'message' => 'Xóa Thành Công']);
    }





}
