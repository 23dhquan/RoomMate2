<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Deposit;
use App\Models\House;
use App\Models\Tenant;
use App\Models\TenantDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepositController extends Controller
{
    public function index()
    {

        $curentArea = auth()->user();
        if($curentArea->is_super_admin ===1) {
            $deposits = Deposit::all();
        } else {
            $deposits = Deposit::whereHas('house', function ($query) use ($curentArea) {
                $query->where('area_id', $curentArea->area_id);
            })->get();
        }
        foreach ($deposits as $deposit) {

            $tenantDetail = TenantDetail::where('tenant_detail_id', $deposit->tenant_detail_id)
                ->where('leader', 1)
                ->first();


            $deposit->depost_tenant = $tenantDetail ? $tenantDetail->full_name : 'N/A';

            $house = House::where('house_id', $deposit->house_id)->first();
            $deposit->house_name = $house ? $house->name : null;


        }

        return view('admin.page.deposit.deposit_listting', compact('deposits'));
    }


    public function create() {

        $currentUser = auth()->user();
        $currentAreaId = $currentUser->is_super_admin;


        $tenants = Tenant::where('is_delete', 0)
            ->where(function ($query) use ($currentAreaId) {
                if ($currentAreaId === 1) {
                    $query->whereIn('house_id', function ($subQuery) use ($currentAreaId) {
                        $subQuery->select('house_id')
                            ->from('houses')
                            ->where('area_id', $currentAreaId);
                    });
                }
             })
            ->get();

        $tenantIds = $tenants->pluck('tenant_id');


        $filteredTenants = $tenants->filter(function ($tenant) {
            $hasDeposit = Deposit::where('tenant_detail_id', $tenant->tenant_id)
                ->where('status', 0)
                ->exists();
            return !$hasDeposit;
        });

        foreach ($filteredTenants as $tenant) {
            $leader = TenantDetail::where('tenant_id', $tenant->tenant_id)
                ->where('leader', 1)
                ->first();

            $tenant->tenant_user = $leader ? $leader->full_name : 'Không có leader';

            $tenantDetailId = TenantDetail::where('tenant_id', $tenant->tenant_id);
            $tenant->tenant_detail_id= $tenantDetailId ? $tenantDetailId->first()->tenant_detail_id : null;

        }


        return view('admin.page.deposit.deposit_create', compact('filteredTenants'));
    }


    public function getHouseName($house_id)
    {
        $house = House::find($house_id);

        if ($house) {
            return response()->json(['name' => $house->name]);
        } else {
            return response()->json(['name' => 'Không tìm thấy nhà'], 404);
        }
    }
    public  function store(Request $request){
        $request -> validate([
            'tenant_detail_id' => 'required|integer',
            'house_id' => 'required|integer',
            'amount' => 'required|integer',
            'deposit_date' => 'required|date',

        ]);

        Deposit::create([

            'tenant_detail_id' =>$request->tenant_detail_id,
            'house_id' => $request ->house_id,
            'amount' => $request ->amount,
            'deposit_date' => $request ->deposit_date,
            'status' => 0
        ]);
        return redirect()->route('deposit.list');
    }
    public function destroy($deposit_id)
    {
        $deposit = Deposit::findOrFail($deposit_id);
        $deposit->delete();
        return redirect()->back()->with('success', 'Slider deleted successfully');
    }

    public function updateStatus($deposit_id)
    {
        $depoosit = Deposit::find($deposit_id);
        $depoosit->status = 1;
        $depoosit->save();
        return redirect()->back()->with('success', 'Deposit updated successfully');
    }
}
