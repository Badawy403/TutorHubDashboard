<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Tenant;
use App\Models\RolePermission;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('super_admins.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        $tenants = Tenant::active()->get();
        return view('super_admins.roles.create', compact('permissions' , 'tenants'));
    }

    public function store(CreateRequest $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $role_code = strtolower(str_replace(' ', '_', trim($data['name'])));
            $check = Role::query()->where(['name' => $data['name'], 'role_code' => $role_code])->first();
            if ($check) {
                return redirect()->back()->with([
                    'message' => 'Role already exist',
                    'message_type' => 'error'
                ]);
            } else {
                $role = Role::create([
                    'tenant_id' => $data['tenant_id'],
                    'name' => $data['name'],
                    'is_active' => 1,
                    'role_code' => $role_code
                ]);

                if ($role && $request->permissions) {
                      $role->role_permissions()->attach($request->permissions);
                }
                DB::commit();
            }

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.roles.index')->with([
                'message' => 'Something went wrong',
                'message_type' => 'error'
            ]);
        }
        return redirect()->route('super_admin.roles.index')->with([
            'message' => 'Role created successfully',
            'message_type' => 'success'
        ]);
    }

    public function edit(Role $role)
    {
        $rolePermissions = array();
        $permissions = Permission::all();
        $rolePermissions = $role->role_permissions->pluck('permission_code')->toArray();
        return view('super_admins.roles.edit', compact('permissions', 'role', 'rolePermissions'));
    }

    public function update(UpdateRequest $request, Role $role)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
          //  $role_code = strtolower(str_replace(' ', '_', trim($data['name'])));

            // $role->update([
            //     'name' => $data['name'],
            //     'role_code' => $role_code
            // ]);
            if ($role && $request->permissions) {
              $role->role_permissions()->sync($request->permissions);
            }
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('super_admin.roles.index')->with([
                'message' => 'Something went wrong',
                'message_type' => 'error'
            ]);
        }
        return redirect()->route('super_admin.roles.index')->with([
            'message' => 'Role updated successfully',
            'message_type' => 'success'
        ]);

    }
    public function getPermissionsExceptRole(Request $request)
    {
        $permissions =  SuperAdminsGeneralController::getPermissionsExceptRole($request);
        $response = generateResponse($permissions,count($permissions) > 0 ? true:false,'Permissions Fetched Successfully',null,'collection');
        return response()->json($response , 200);
    }



}
