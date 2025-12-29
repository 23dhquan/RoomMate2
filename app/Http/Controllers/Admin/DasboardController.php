<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ElectricityBill;
use App\Models\House;
use App\Models\HouseBill;
use App\Models\HouseService;
use App\Models\Service;
use App\Models\Tenant;
use App\Models\TenantDetail;
use App\Models\WaterBill;
use Carbon\Carbon;
use Illuminate\Http\Request;


class DasboardController extends Controller
{
    public function index(Request $request)
    {
        $loggedInUser = auth()->user();

        $year = $request->input('year', Carbon::now()->year);

        if ($loggedInUser->is_super_admin == 1) {
            $houses = House::all();
        } else {
            $houses = House::where('area_id', $loggedInUser->area_id)->get();
        }
        $monthlyTotals = [];
        $waterTotalForYear = 0;
        $electricityTotalForYear = 0;
        $houseBillTotalForYear = 0;
        for ($month = 1; $month <= 12; $month++) {
            $totalAmountForMonth = 0;
            foreach ($houses as $house) {
                $waterBillAmount = WaterBill::where('house_id', $house->house_id)
                    ->whereYear('billing_date', $year)
                    ->whereMonth('billing_date', $month)
                    ->sum('amount');
                $electricityBillAmount = ElectricityBill::where('house_id', $house->house_id)
                    ->whereYear('billing_date', $year)
                    ->whereMonth('billing_date', $month)
                    ->sum('amount');
                $houseBillAmount = HouseBill::where('house_id', $house->house_id)
                    ->whereYear('billing_date', $year)
                    ->whereMonth('billing_date', $month)
                    ->sum('amount');
                $totalAmountForMonth += $waterBillAmount + $electricityBillAmount + $houseBillAmount;
                $waterTotalForYear += $waterBillAmount;
                $electricityTotalForYear += $electricityBillAmount;
                $houseBillTotalForYear += $houseBillAmount;
            }

            $monthlyTotals[$month] = $totalAmountForMonth;
        }

        $yearlyTotals = [
            'water' => $waterTotalForYear,
            'electricity' => $electricityTotalForYear,
            'house_bill' => $houseBillTotalForYear,
        ];

        $services = HouseService::all();
        $totalPrice = 0;

        foreach ($services as $service) {
            $servicePrice = Service::where('service_id', $service->service_id)->first();

            if ($servicePrice) {
                $totalPrice += $servicePrice->price;
            }
        }
        $waterBillAmountTotal = 0;
        $electricityBillAmountTotal = 0;
        $houseBillAmountTotal = 0;

        foreach ($houses as $house) {
            $waterBillAmountTotal += WaterBill::where('house_id', $house->house_id)->sum('amount');

            $electricityBillAmountTotal += ElectricityBill::where('house_id', $house->house_id)->sum('amount');

            $houseBillAmountTotal += HouseBill::where('house_id', $house->house_id)->sum('amount');
        }
        $totalAmountAll = $totalPrice + $waterBillAmountTotal + $electricityBillAmountTotal + $houseBillAmountTotal;

        $currentUser = auth()->user();
        $currentAreaId = $currentUser->area_id;

        $tenantIds = Tenant::whereHas('house', function ($query) use ($currentAreaId) {
            $query->where('area_id', $currentAreaId);
        })->pluck('tenant_id');
        if($currentUser-> is_super_admin ==1 )
        {
            $toltalTenant = TenantDetail::all()->count();
        }
        else
        {
            $toltalTenant = TenantDetail::whereIn('tenant_id', $tenantIds)->count();
        }
        if ($currentUser-> is_super_admin ==1)
        {
            $toltalHouse = House::all()->count();
        }
        else
        {
            $toltalHouse = House::where('area_id', $currentAreaId)->count();
        }

        return view('admin.dashboard', compact('monthlyTotals', 'toltalTenant' ,'toltalHouse' , 'yearlyTotals', 'year','totalPrice','totalAmountAll'));


    }
}
