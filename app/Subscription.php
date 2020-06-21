<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Subscription extends Model
{
    const visible=1;
    const not_visible=0;
    const silver=1;
    const gold=2;
    const diamond=3;

   
}
