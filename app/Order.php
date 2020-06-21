<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable =['used_coupons'];

    public function mobile_users()
    {
        return $this->belongsTo('App\MobileUser','mobile_user_id');
    }


    public function address()
    {
        return $this->belongsTo(MobileUserAdress::class);
    }

    public function order_item()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function business()
    {
        return $this->belongsTo('App\User','business_id');
    }

    public function scopePending($query) {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query) {
        return $query->where('status', 'approved');
    }

    public function scopeDelivered($query) {
        return $query->where('status', 'delivered');
    }

    public function scopeRefused($query) {
        return $query->where('status', 'refused');
    }

    public function scopeDelivering($query) {
        return $query->where('status', 'delivering');
    }
}
