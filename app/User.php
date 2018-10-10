<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    public function usertype()
    {
        return $this->belongsTo('App\UserType', 'user_type_id');
    }
}
