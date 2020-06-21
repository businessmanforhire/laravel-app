<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CouponType extends Model
{
    use SoftDeletes;

    const visible=1;
    const not_visible=0;

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

}
