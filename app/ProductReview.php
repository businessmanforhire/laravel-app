<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    public function business()
    {
        return $this->hasMany(BusinessInfo::class);
    }

    public function mobile_user()
    {
        return $this->belongsTo('App\MobileUser','mobile_user_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }
}
