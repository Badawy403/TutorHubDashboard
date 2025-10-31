<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateRequest;
use App\Models\Setting;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Hash;


class ProfileController extends Controller
{

    public function index(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('super_admins.profile.index')->with('user', $user);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            } else {
                unset($data['password']);
            }
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->file('profile_image_path')) {
                $image = $request->file('profile_image_path');
                $name = strtotime(now()) . $image->getClientOriginalName();
                $image->move(public_path() . '/profile_images/', $name);
                $data['profile_image_path'] = '/profile_images/' . $name;
            }
            $super_admin = $user->update($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.profile.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        if ($request->filled('password')) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('super_admin.login')->with('message', 'Password Changed Successfully')->with('message_type', 'success');
        }
        return redirect()->route('super_admin.profile.index')->with('message', 'Profile Updated Successfully')->with('message_type', 'success');
    }
}
