<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public function coupon_type()
    {
        return $this->belongsTo(CouponType::class,'type');
    }

}
