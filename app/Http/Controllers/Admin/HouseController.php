<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\House;
use App\Models\HouseImage;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HouseController extends Controller
{
    public function index()
    {
        $curentArea = auth()->user();
        if($curentArea->is_super_admin ===1) {
            $houses = House::all();
        } else {
            $houses =House::where('area_id', $curentArea->area_id)->get();
        }
        foreach ($houses as $house) {
            $house->area_name = Area::find($house->area_id)->name;
        }
        return view('admin.page.house.house_listting', compact('houses'));
    }


    public function create()
    {
        $curentArea = auth()->user();
        if($curentArea->is_super_admin ===1) {
            $areas = Area::all();
        } else {
            $areas =Area::where('area_id', $curentArea->area_id)->get();
        }
        return view('admin.page.house.add_house',compact('areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'area_id' => 'required|integer',
            'description' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $house = House::create([
            'name' => $request->name,
            'price' => $request->price,
            'area_id' => $request->area_id,
            'description' => $request->description
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('houses_image'), $filename);

                HouseImage::create([
                    'house_id' => $house->house_id,
                    'image_path' => 'houses_image/' . $filename
                ]);
            }
        }


        return redirect()->route('house.list')->with('success', 'Phòng thuê đã được thêm thành công.');
    }

    public function destroy($house_id)
    {
        $house = House::findOrFail($house_id);
        $house->delete();
        return redirect()->back()->with('success', 'Slider deleted successfully');
    }

    public function edit($id)
    {
        $house = House::findOrFail($id);
        $images = HouseImage::where('house_id', $id)->get();
        $curentArea = auth()->user();
        if($curentArea->is_super_admin ===1) {
            $areas = Area::all();
        } else {
            $areas =Area::where('area_id', $curentArea->area_id)->get();
        }
        return view('admin.page.house.edit_house', compact('house', 'images', 'areas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'area_id' => 'required|integer',
            'description' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $house = House::findOrFail($id);
        $house->update([
            'name' => $request->name,
            'price' => $request->price,
            'area_id' => $request->area_id,
            'description' => $request->description
        ]);

        if ($request->hasFile('images')) {
            $oldImages = HouseImage::where('house_id', $house->house_id)->get();
            foreach ($oldImages as $oldImage) {
                $oldImagePath = public_path($oldImage->image_path);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                $oldImage->delete();
            }

            // Lưu ảnh mới
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('houses_image'), $filename);

                HouseImage::create([
                    'house_id' => $house->house_id,
                    'image_path' => 'houses_image/' . $filename
                ]);
            }
        }

        return redirect()->route('house.list')->with('success', 'Phòng thuê đã được cập nhật thành công.');
    }


    public function tenant()
    {

        $curentArea = auth()->user();
        if($curentArea->is_super_admin ===1) {
            $houses = House::all();
        } else {
            $houses =House::where('area_id', $curentArea->area_id)->get();
        }

        $filteredUsers = User::where('role', 'tenant')
            ->when($curentArea->area_id != 0, function ($query) use ($curentArea) {
                return $query->where('area_id', $curentArea->area_id);
            })
            ->whereNotIn('user_id', function($query) {
                $query->select('user_id')->from('tenants')->where('is_delete', 0);
            })
            ->get();


        foreach ($houses as $house) {
            $isRented = Tenant::where('house_id', $house->house_id)
                ->where('is_delete', 0)
                ->exists();

            $house->is_rented = $isRented ? 1 : 0;

            $house->update(['is_rented' => $house->is_rented]);
        }


        foreach ($houses as $house) {
            $house->area_name = $house->getAreaName();
        }

        return view('admin.page.tenant.tenant_listting', compact('houses', 'filteredUsers'));
    }










}
