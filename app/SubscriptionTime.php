<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionTime extends Model
{
    use SoftDeletes;
    public $table='subscription_times';

    public function business_subscription()
    {
        return $this->belongsTo('App\BusinessSubscription','month_id');
    }
}
