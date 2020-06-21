<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    const  unseen='0';
    const seen='1';
    public function business()
    {
        return $this->hasMany(BusinessInfo::class);
    }

    public function mobile_user()
    {
        return $this->belongsTo('App\MobileUser','mobile_user_id');
    }
}
