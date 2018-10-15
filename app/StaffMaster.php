<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffMaster extends Model
{
    //
    public function orgmaster()
    {
        # code...
        return $this->belongsTo('App\OrgMaster','org_id');
    }
}
