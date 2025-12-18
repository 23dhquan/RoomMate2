<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $currentUser = auth()->user();

        if ($currentUser->is_super_admin === 1) {
            $user = User::all();
        } else {
            $user = User::where('area_id', $currentUser->area_id)->get();
        }
        return view('admin.page.user.user_lissting', compact('user'));
    }
    public function create()
    {
        $curentArea = auth()->user();
        if($curentArea->is_super_admin ===1) {
            $areas = Area::all();
        } else {
            $areas =Area::where('area_id', $curentArea->area_id)->get();
        }

        return view('admin.page.user.add_user', compact('areas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'note' => 'nullable|string|max:255',
            'role' => 'required|string|max:255',
            'area_id' => 'required|integer',
            'phone' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'note' => $request->note,
            'role' => $request->role,
            'area_id' => $request->area_id,
            'phone' => $request->phone,

        ]);

        return redirect()->route('user.list')->with('success', 'User created successfully!');
    }

    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();
        return redirect()->back()->with('user_id', 'user deleted successfully');
    }
    public function edit($user_id)
    {
        $users= User::findOrFail($user_id);
        $curentArea = auth()->user();
        if($curentArea->is_super_admin ===1) {
            $areas = Area::all();
        } else {
            $areas =Area::where('area_id', $curentArea->area_id)->get();
        }
        return view('admin.page.user.edit_user', compact('users','areas'));
    }
    public function update(Request $request, $user_id)
    {
        $users = User::findOrFail($user_id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user_id . ',user_id',
            'password' => 'nullable|string|min:6|confirmed',
            'note' => 'nullable|string|max:255',
            'role' => 'required|string|max:255',
            'area_id' => 'required|integer',
            'phone' => 'required|string',

        ]);

        $users->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $users->password,
            'note' => $request->note,
            'role' => $request->role,
            'area_id' => $request->area_id,
            'phone' => $request->phone,

        ]);

        return redirect()->route('user.list')->with('success', 'User updated successfully!');
    }


    public function toggleStatus($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        $user->status = !$user->status;
        $user->save();

        return response()->json(['success' => true, 'status' => $user->status]);
    }





}
