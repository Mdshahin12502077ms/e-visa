<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'traveller',
        'processing_time',
        'gob_taxes',
        'sub_total',
        'total',
        'payment_status',
        'user_id',
        'visa_infos_id',
        'package_id',
        'status',
    ];

    public function visaInfo(){
        return $this->belongsTo(VisaInfos::class,'visa_infos_id','id');
    }

    public function package(){
        return $this->belongsTo(Package::class,'package_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}

