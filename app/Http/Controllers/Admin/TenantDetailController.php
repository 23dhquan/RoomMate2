<?php

namespace App\Http\Controllers\Admin;

use App\Models\House;
use App\Models\Tenant;
use App\Models\TenantDetail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class TenantDetailController extends Controller
{
    public function index()
    {
        $tenantDetails = TenantDetail::all();
        foreach ($tenantDetails as $tenantDetail) {
            $tenant = Tenant::find($tenantDetail->tenant_id);

            if ($tenant) {
                if ($tenant->is_delete == 1) {
                    $tenantDetail->house_name_teantDetail = "Đã chấm dứt thuê";
                } else {
                    $houseId = $tenant->house_id ?? null;

                    if ($houseId) {
                        $house = House::find($houseId);
                        if ($house) {
                            $tenantDetail->house_name_teantDetail = $house->name ?? "Đang Trống";
                        } else {
                            $tenantDetail->house_name_teantDetail = "Đang Trống";
                        }
                    } else {
                        $tenantDetail->house_name_teantDetail = "Đang Trống";
                    }
                }
            } else {
                $tenantDetail->house_name_teantDetail = "Đang Trống";
            }
        }

        return view('admin.page.tenant.detail.detail_listting', compact('tenantDetails'));
    }


    public function create()
    {
        $currentUser = auth()->user();
        $currentAreaId = $currentUser->is_super_admin;

        $tenants = Tenant::where('is_delete', 0)
            ->where(function ($query) use ($currentAreaId, $currentUser) {
                if ($currentAreaId == 1) {
                    $query->whereIn('house_id', function ($subQuery) {
                        $subQuery->select('house_id')
                            ->from('houses')
                            ->where('is_rented', 1);
                    });
                } else {
                    $query->whereIn('house_id', function ($subQuery) use ($currentUser) {
                        $subQuery->select('house_id')
                            ->from('houses')
                            ->where('area_id', $currentUser->area_id)
                            ->where('is_rented', 1);
                    });
                }
            })
            ->get();



        foreach ($tenants as $teant)
        {
            $house = House::find($teant->house_id);
            $teant->house_name=$house->name;
        }
        return view('admin.page.tenant.detail.detail_create',compact('tenants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tenant_id' => 'required|integer',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'identity_card' => 'required|string|max:20',
            'identity_card_image.*' => 'nullable|image',
            'portrait_image' => 'nullable|image',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
            'leader' => 'boolean',
        ]);


        $tenantDetail = new TenantDetail();
        $tenantDetail->tenant_id = $request->tenant_id;
        $tenantDetail->full_name = $request->full_name;
        $tenantDetail->phone = $request->phone;
        $tenantDetail->email = $request->email;
        $tenantDetail->identity_card = $request->identity_card;

        $images = [];
        $folderName = str_replace(' ', '_', $request->full_name);
        $baseFolderPath = public_path('/tenant_images/' . $folderName);

        if (!file_exists($baseFolderPath)) {
            mkdir($baseFolderPath, 0777, true);
        }

        if ($request->hasFile('identity_card_image')) {
            foreach ($request->file('identity_card_image') as $key => $file) {
                $identityCardImageName = 'identity_card_' . $key . '.' . $file->getClientOriginalExtension();

                $file->move($baseFolderPath, $identityCardImageName);

                $images[] = 'tenant_images/' . str_replace(' ', '_', $folderName) . '/' . $identityCardImageName;
            }
            $tenantDetail->identity_card_image = json_encode($images, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }



        if ($request->hasFile('portrait_image')) {
            $portraitImageName = 'portrait.' . $request->file('portrait_image')->getClientOriginalExtension();
            $request->file('portrait_image')->move($baseFolderPath, $portraitImageName);
            $tenantDetail->portrait_image = 'tenant_images/' . $folderName . '/' . $portraitImageName;
        }

        $tenantDetail->gender = $request->gender;
        $tenantDetail->date_of_birth = $request->date_of_birth;
        $tenantDetail->leader = $request->leader ?? 0;

        $tenantDetail->save();

        return redirect()->back()->with('success', 'Thêm thông tin người thuê thành công.');
    }
    public function edit($id)
    {
        $currentUser = auth()->user();
        $currentAreaId = $currentUser->is_super_admin;

        $tenants = Tenant::where('is_delete', 0)
            ->where(function ($query) use ($currentAreaId, $currentUser) {
                if ($currentAreaId == 1) {
                    $query->whereIn('house_id', function ($subQuery) {
                        $subQuery->select('house_id')
                            ->from('houses')
                            ->where('is_rented', 1);
                    });
                } else {
                    $query->whereIn('house_id', function ($subQuery) use ($currentUser) {
                        $subQuery->select('house_id')
                            ->from('houses')
                            ->where('area_id', $currentUser->area_id)
                            ->where('is_rented', 1);
                    });
                }
            })
            ->get();

        foreach ($tenants as $teant)
        {
            $house = House::find($teant->house_id);
            $teant->house_name=$house->name;
        }
        $tenantDetail = TenantDetail::findOrFail($id);
        return view('admin.page.tenant.detail.detail_edit', compact('tenantDetail','tenants'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tenant_id' => 'required|integer',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'identity_card' => 'required|string|max:20',
            'identity_card_image.*' => 'nullable|image',
            'portrait_image' => 'nullable|image',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'leader' => 'boolean',
        ]);

        $tenantDetail = TenantDetail::findOrFail($id);
        $tenantDetail->tenant_id = $request->tenant_id;
        $tenantDetail->full_name = $request->full_name;
        $tenantDetail->phone = $request->phone;
        $tenantDetail->email = $request->email;
        $tenantDetail->identity_card = $request->identity_card;

        $images = [];
        $folderName = str_replace(' ', '_', $request->full_name);
        $baseFolderPath = public_path('/tenant_images/' . $folderName);

        if (!file_exists($baseFolderPath)) {
            mkdir($baseFolderPath, 0777, true);
        }

        if ($request->hasFile('identity_card_image')) {
            foreach ($request->file('identity_card_image') as $key => $file) {
                $identityCardImageName = 'identity_card_' . $key . '.' . $file->getClientOriginalExtension();
                $file->move($baseFolderPath, $identityCardImageName);
                $images[] = 'tenant_images/' . str_replace(' ', '_', $folderName) . '/' . $identityCardImageName;
            }
            $tenantDetail->identity_card_image = json_encode($images, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }

        if ($request->hasFile('portrait_image')) {
            $portraitImageName = 'portrait.' . $request->file('portrait_image')->getClientOriginalExtension();
            $request->file('portrait_image')->move($baseFolderPath, $portraitImageName);
            $tenantDetail->portrait_image = 'tenant_images/' . $folderName . '/' . $portraitImageName;
        }

        $tenantDetail->gender = $request->gender;
        $tenantDetail->date_of_birth = $request->date_of_birth;
        $tenantDetail->leader = $request->leader ?? 0;

        $tenantDetail->save();

        return redirect()->route('tenant-detail.list');
    }

    public function destroy($tenant_detail_id){
        $tenantDetail= TenantDetail::findOrFail($tenant_detail_id);
        $tenantDetail->delete();
        return redirect()->back()->with('Delete successfully');
    }




}
