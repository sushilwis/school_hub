<?php

namespace App\Http\Controllers;
use Response;

use App\RolePermissions;

use Illuminate\Http\Request;
use App\Http\Resources\Rolepermission as  RolePermissionResource;

class RolePermissionController extends Controller
{
    //
    public function loginRole(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = json_decode($request->getContent(), true);
            if (isset($data['master_id']) && isset($data['user_type_id']) ) {
                $permission = RolePermissions::with(['Role','Module'])
                    ->where(['role_permissions.master_id' => $data['master_id'],'role_permissions.user_type_id'=> $data['user_type_id']])
                    ->get();

            }else{
                return Response::json(array('Error'=>"Parameter Missing"));
            }

        }
        return RolePermissionResource::collection($permission);
    }
    public function addPermission(Request $request)
    {

    }
}
