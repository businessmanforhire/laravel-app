<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobileUserAdress extends Model
{
    public $table='mobile_users_addresses';

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
