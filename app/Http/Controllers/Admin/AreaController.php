<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class AreaController extends Controller
{
    public function index() {
        if (auth()->user()->note === 'Quản Trị Viên') {
            return redirect()->route('house.list')->with('error', 'Admin thì không cho vào');
        }
        $areas = Area::all();
        return view('admin.page.area.area_lissting', compact('areas'));
    }
    public function create()
    {
        return view('admin.page.area.add_area');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        Area::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);


        return redirect()->route('area.list');
    }

    public function destroy($area_id)
    {
        $area = Area::findOrFail($area_id);
        $area->delete();
        return redirect()->back()->with('success', 'Slider deleted successfully');
    }
    public function edit($area_id)
    {
        $area = Area::findOrFail($area_id);
        return view('admin.page.area.edit_area', compact('area'));
    }
    public function update(Request $request, $area_id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);
        $area = Area::findOrFail($area_id);
        $area->update([
           'name' => $request->name,
            'address' => $request->address,

        ]);
        return redirect()->route('area.list');
    }




}
