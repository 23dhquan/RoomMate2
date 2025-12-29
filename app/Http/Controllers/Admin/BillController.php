<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ElectricityBill;
use App\Models\House;
use App\Models\HouseBill;
use App\Models\Tenant;
use App\Models\User;
use App\Models\WaterBill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BillController extends Controller
{

    public function index()
    {
        $currentArea = auth()->user();

        if ($currentArea->is_super_admin === 1) {
            $tenants = Tenant::where('is_delete', 0)->get();
        } else {
            $houses = House::where('area_id', $currentArea->area_id)->pluck('house_id');
            $tenants = Tenant::where('is_delete', 0)->whereIn('house_id', $houses)->get();
        }

        foreach ($tenants as $tenant) {
            $tenant->house_name = House::find($tenant->house_id)->name;
            $tenant->user_name = User::find($tenant->user_id)->name;

            $lastWaterBill = WaterBill::where('house_id', $tenant->house_id)
                ->orderBy('billing_date', 'desc')
                ->first();

            $tenant->bill_water_date = $lastWaterBill ? 'Tháng ' . Carbon::parse($lastWaterBill->billing_date)->format('m') : 'Chưa Có';
        }

        return view('admin.page.bill.manager_listting', compact('tenants'));
    }



    public function createBill(Request $request)
    {
        $selectedHouseId = $request->house_id;

        return view('admin.page.bill.create_bills', compact( 'selectedHouseId'));
    }

    public function storeBill(Request $request)
    {
        $request->validate([
            'house_id' => 'required|exists:houses,house_id',
            'electricity_reading' => 'required|numeric',
            'water_reading' => 'required|numeric',
            'billing_date' => 'required|date',
            'electricity_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'water_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $lastWaterBill = WaterBill::where('house_id', $request->house_id)
            ->orderBy('billing_date', 'desc')
            ->first();
        $lastElectricityBill = ElectricityBill::where('house_id', $request->house_id)
            ->orderBy('billing_date', 'desc')
            ->first();
        $waterReading = $request->water_reading;
        $electricityReading = $request->electricity_reading;
        $previousWaterReading = $lastWaterBill ? $lastWaterBill->water_reading : 0;
        $previousElectricityReading = $lastElectricityBill ? $lastElectricityBill->electricity_reading : 0;
        $water = $waterReading <= $previousWaterReading ? $waterReading  :$waterReading - $previousWaterReading ;
        $waterAmount = $water * 15000;
        $electricity = $electricityReading <= $previousElectricityReading ? $electricityReading : $electricityReading - $previousElectricityReading;
        if ($electricity <= 50) {
            $electricityAmount = $electricity * 2000;
        } elseif ($electricity <= 100) {
            $electricityAmount = (50 * 2000) + (($electricity - 50) * 3000);
        } elseif ($electricity <= 200) {
            $electricityAmount = (50 * 2000) + (50 * 3000) + (($electricity - 100) * 4000);
        } else {
            $electricityAmount = (50 * 2000) + (50 * 3000) + (100 * 4000) + (($electricity - 200) * 5000);
        }
        $electricityImagePath = null;
        if ($request->hasFile('electricity_image')) {
            $electricityImage = $request->file('electricity_image');
            $electricityImagePath = 'electricity_bills/' . $electricityImage->getClientOriginalName();
            $electricityImage->move(public_path('electricity_bills'), $electricityImagePath);
        }
        $waterImagePath = null;
        if ($request->hasFile('water_image')) {
            $waterImage = $request->file('water_image');
            $waterImagePath = 'water_bills/' . $waterImage->getClientOriginalName();
            $waterImage->move(public_path('water_bills'), $waterImagePath);
        }
        ElectricityBill::create([
            'house_id' => $request->house_id,
            'electricity_reading' => $request->electricity_reading,
            'billing_date' => $request->billing_date,
            'electricity_image' => $electricityImagePath,
            'amount' => $electricityAmount,
            'status' => 0,
        ]);
        WaterBill::create([
            'house_id' => $request->house_id,
            'water_reading' => $request->water_reading,
            'billing_date' => $request->billing_date,
            'water_image' => $waterImagePath,
            'amount' => $waterAmount,
            'status' => 0,
        ]);
        $mountHouse = House::find($request->house_id)->price;
        HouseBill::create([
            'house_id' => $request->house_id,
            'billing_date' => $request->billing_date,
            'amount' => $mountHouse,
            'status' => 0,

        ]);
        return redirect()->route('bills.list')->with('success', 'Hóa đơn điện và nước đã được thêm thành công.');
    }

    public function bill()
    {
        $currentArea = auth()->user();

        if ($currentArea->is_super_admin === 1) {
            $waterBills = WaterBill::all();
            $electricityBills = ElectricityBill::all();
            $houseBills = HouseBill::all();
        } else {
            $houses = House::where('area_id', $currentArea->area_id)->pluck('house_id');

            $waterBills = WaterBill::whereIn('house_id', $houses)->get();
            $electricityBills = ElectricityBill::whereIn('house_id', $houses)->get();
            $houseBills = HouseBill::whereIn('house_id', $houses)->get();
        }

        foreach ($waterBills as $waterBill) {
            $waterBill->house_name = House::find($waterBill->house_id)->name;
        }

        foreach ($electricityBills as $electricityBill) {
            $electricityBill->house_name = House::find($electricityBill->house_id)->name;
        }
        foreach ($houseBills as $houseBill) {
            $houseBill->house_name = House::find($houseBill->house_id)->name;
        }

        return view('admin.page.bill.bills_list', compact('waterBills', 'electricityBills','houseBills'));
    }


    public function updateStatus(Request $request)
    {
        $billType = $request->input('bill_type');
        $billId = $request->input('bill_id');

        switch ($billType) {
            case 'water':
                $bill = WaterBill::find($billId);
                break;
            case 'electricity':
                $bill = ElectricityBill::find($billId);
                break;
            case 'house':
                $bill = HouseBill::find($billId);
                break;
            default:
                return redirect()->back()->with('error', 'Loại hóa đơn không hợp lệ.');
        }

        if ($bill) {
            $bill->status = 1;
            $bill->save();

            return redirect()->back()->with('success', 'Hóa đơn đã được cập nhật thành công.');
        }

        return redirect()->back()->with('error', 'Không tìm thấy hóa đơn.');
    }

}

