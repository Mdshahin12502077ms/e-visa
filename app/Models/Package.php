<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'title',
        'validity',
        'maximum_stay_per_entry',
        'service_fee',
        'goverment_fee',
        'processing_time',
        'travaller',
        'status',
    ];

    public function order(){
        return $this->hasMany(Order::class,'package_id','id');
    }
}
