<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentMaster extends Model
{
    //
    public function user()
    {
        # code...
        return $this->hasMany('App\User');
    }
    public function orgmaster()
    {
        # code...
        return $this->belongsTo('App\OrgMaster','org_id');
    }
}
