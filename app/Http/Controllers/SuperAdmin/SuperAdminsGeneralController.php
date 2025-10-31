<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use App\Models\Tenant;
use App\Models\SubClient;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;

class SuperAdminsGeneralController extends Controller
{
    public static function getNewsCategoriesByTenant($request)
    {
        $news_categories = NewsCategory::active();
        if ($request->filled('tenant_id')) {
            $news_categories = $news_categories->where('tenant_id', $request->tenant_id);
        }
        $news_categories = $news_categories->get();
        return $news_categories;
    }

    public static function getPermissionsExceptRole($request)
    {
        $response = array();
        $role = Role::where('role_code', $request->role_code)->first();
        $role_permissions = $role->role_permissions->pluck('permission_code')->toArray();
        $permissions = Permission::whereNotIn('permission_code', $role_permissions);
        $permissions = $permissions->get();
         $currentPermissions = array();
         $currentRole = '';
         if ($request->user_id) {
             $user = User::query()->with(['user_permissions', 'user_roles'])->where('id', $request->user_id)->first();
             $currentPermissions = $user->user_permissions->pluck('permission_code')->toArray();
             $currentRole = $user->user_roles()->first() ? $user->user_roles()->first()->role_code : "";
         }
         $userPermissions = array();
         foreach ($permissions as $permission) {
             if (in_array($permission->permission_code, $currentPermissions) && $request->role_code == $currentRole) {
                 $userPermissions[] = [
                     'code' => $permission->permission_code,
                     'name' => $permission->name,
                     'flag' => true
                 ];
             } else {
                 $userPermissions[] = [
                     'code' => $permission->permission_code,
                     'name' => $permission->name,
                     'flag' => false
                 ];
             }
         }
         if (count($permissions) == count($currentPermissions)  && $request->role_code == $currentRole) {
             $response['all_permissions_status'] = true;
         } else {
             $response['all_permissions_status'] = false;
         }


         $response['permissions'] = $userPermissions;

        return $response;
    }
  public static function getSubClientsByTenant($tenant_id)
  {
      $sub_clients = SubClient::active()->get();
      return $sub_clients;
  }
  public static function getNewsCategoriesByTenantAndSubClient($request)
  {
      $news_categories = NewsCategory::active();
      if($request->filled('tenant_id')){
        $news_categories = $news_categories->where('tenant_id' , $request->tenant_id);
      }
      if($request->filled('sub_client_id')){
        $news_categories = $news_categories->where('sub_client_id' , $request->sub_client_id);
      }
      $news_categories = $news_categories->get();
      return $news_categories;
  }
  public static function getParentTenants()
  {
      $tenants = Tenant::where('parent_tenant_id' , 0)->orWhereNull('parent_tenant_id')->get();
      return $tenants;
  }

  public static function getUsersAndConsultantsByTenant($request)
  {
      $response['users'] = User::whereTenant($request->tenant_id)->active()->whereHasRole(UserRole::USER)->get();
      $response['consultants'] = User::whereTenant($request->tenant_id)->active()->whereHasRole(UserRole::CONSULTANT)->get();
      return $response;
  }


}
