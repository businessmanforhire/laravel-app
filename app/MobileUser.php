<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


class MobileUser extends Authenticatable
{
    use HasApiTokens;

    public $table='mobile_users';

    const active=1; const inactive=0;

    protected $fillable = [
        'name', 'email', 'password','attempts','code','phone_verification','sent','sent_at','verified','active_device','platform'
    ];


    public function order()
    {
        return $this->hasOne('App\Order');
    }

    public function business_categories()
    {
        return $this->belongsToMany('App\BusinessCategory');
    }

    public function review()
    {
        return $this->hasOne('App\Review');
    }

    public function product_review()
    {
        return $this->hasOne('App\ProductReview');
    }
}
