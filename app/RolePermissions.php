<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolePermissions extends Model
{
    //
    public function role()
    {
        # code...
        return $this->belongsTo('App\Role','role_id');
    }
    public function module()
    {
        # code...
        return $this->belongsTo('App\Module','module_id');
    }
}
