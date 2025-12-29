<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use App\Models\House;
use App\Models\Penalty;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenaltyController extends Controller
{
    public function index()
    {
        $currentUser = auth()->user();
        $penalties = Penalty::with('house')->get();

        if ($currentUser->is_super_admin != 1) {
            $penalties = $penalties->filter(function ($penalty) use ($currentUser) {
                return $penalty->house->area_id == $currentUser->area_id;
            });
        }

        foreach ($penalties as $penalty) {
            $penalty->house_name = $penalty->house->name ?? "Đang Trống";
        }

        return view('admin.page.penalty.penalty_listting', compact('penalties'));
    }

    public function create()
    {
        $currentUser = auth()->user();

        if ($currentUser->is_super_admin === 1) {
            $tenants = Tenant::where('is_delete', 0)->get();
        } else {
            $tenants = Tenant::with('house')
            ->where('is_delete', 0)
                ->get()
                ->filter(function ($tenant) use ($currentUser) {
                    return $tenant->house->area_id == $currentUser->area_id;
                });
        }


        foreach ($tenants as $tenant) {
            $house = House::find($tenant->house_id);
            $tenant->house_name =  $house->name ;
        }
        return view('admin.page.penalty.penalty_create', compact('tenants'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'penalty_date' => 'required|date',
            'house_id' => 'required|integer',
        ]);

       Penalty::create([
           'description' => $request->description,
           'amount' => $request->amount,
           'penalty_date' => $request->penalty_date,
           'house_id' => $request->house_id,
           'status' => 0
       ]);

       return redirect()->route('penalty.list');

    }
    public function edit($id)
    {
        $penalty = Penalty::findOrFail($id);
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            $house = House::find($tenant->house_id);
            $tenant->house_name = $house ? $house->name : 'Không có nhà';
        }

        return view('admin.page.penalty.penalty_edit', compact('penalty', 'tenants'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'penalty_date' => 'required|date',
            'tenant_id' => 'required|integer',
        ]);

        $penalty = Penalty::findOrFail($id);
        $penalty->update([
            'description' => $request->description,
            'amount' => $request->amount,
            'penalty_date' => $request->penalty_date,
            'tenant_id' => $request->tenant_id
        ]);

        return redirect()->route('penalty.list')->with('success', 'Cập nhật thành công!');
    }
    public function destroy($id)
    {
        $penalty = Penalty::find($id);
        $penalty->delete();
        return redirect()->back()->with('success', 'Service deleted successfully');
    }
    public function updateStatus($id)
    {
        $penalty = Penalty::find($id);
        $penalty->status = 1;
        $penalty->save();

        return redirect()->back()->with('success', 'Service deleted successfully');
    }

}
