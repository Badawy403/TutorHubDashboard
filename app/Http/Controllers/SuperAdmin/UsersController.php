<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = User::query()->withAll()->get();
        return view('super_admins.users.index', compact('users'));
    }

    public function create()
    {
        $tenants = Tenant::active()->get();
        $roles = Role::active()->get();

        return view('super_admins.users.create', compact('tenants', 'roles'));
    }

    public function show(User $user){

        $currentRole = $user->user_roles()->first() ;
        $currentRole = $currentRole ? $currentRole->name : "";

        return view('super_admins.users.show', compact('user',  'currentRole'));
    }

    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $data['password'] = Hash::make($request->password);
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->file('profile_image_path')) {
                $image = $request->file('profile_image_path');
                $name = strtotime(now()) . $image->getClientOriginalName();
                $image->move(public_path() . '/profile_images/', $name);
                $data['profile_image_path'] = '/profile_images/' . $name;
            }
            $user = User::create($data);
            $role_codes[] = $request->role_code;
            $user->user_roles()->attach($role_codes);
            if ($request->filled('permissions')) {
                $user->user_permissions()->attach($request->permissions);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.users.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.users.index')->with('message', 'User Created Successfully')->with('message_type', 'success');
    }

    public function edit(User $user)
    {
        $tenants = Tenant::active()->get();
        $roles = Role::active()->get();
        $currentRole = $user->user_roles()->first() ;
        $currentRole = $currentRole ? $currentRole->role_code : "";

        return view('super_admins.users.edit', compact('tenants', 'user', 'roles', 'currentRole'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            if ($request->file('profile_image_path')) {
                $image = $request->file('profile_image_path');
                $name = strtotime(now()) . $image->getClientOriginalName();
                $image->move(public_path() . '/profile_images/', $name);
                $data['profile_image_path'] = '/profile_images/' . $name;
            }
            if (!$request->is_active) {
                $data['is_active'] = 0;
            }
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }
             $role_codes[] = $request->role_code;
            $user->user_roles()->sync($role_codes);
            if ($request->filled('permissions')) {
                $user->user_permissions()->sync($request->permissions);
            }
            $user->update($data);
            $user->save();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.users.index')->with('message', 'Something Went Wrong')->with('message_type', 'error');
        }
        return redirect()->route('super_admin.users.index')->with('message', 'User Updated Successfully')->with('message_type', 'success');
    }

    public function destroy(User $user)
    {
        if (isset($user->profile_image_path)) {
            Storage::delete($user->profile_image_path);
        }
        $user->delete();
        return redirect()->back()->with('message', 'User Deleted Successfully')->with('message_type', 'success');
    }
}
