<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BusinessSubscription extends Model
{
    protected $dates = ['start_date','end_date'];

    public function months()
    {
        return $this->hasMany(SubscriptionBusiness::class);
    }

    public function businesses()
    {
        return $this->belongsTo(BusinessInfo::class);
    }

    public function scopeSubscription($query) {
        return $query->where('business_id',Auth::id())->where('start_date','<=',date('Y-m-d H:i:s'))->where('end_date','>=',date('Y-m-d H:i:s'));
    }

    public function scopeExpiringsoon($query) {
        return $query->where('business_id',Auth::id())->where('end_date','>=',date('Y-m-d H:i:s'));
    }
}
