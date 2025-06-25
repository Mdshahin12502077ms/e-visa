<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisaInfos extends Model
{
    protected $fillable=[
        'passport_from',
        'passport_to_id',
        'full_name',
        'dob',
        'nationality',
        'pass_port_number',
        'email_address',
        'phone_number',
        'nid_front_end',
        'nid_back_end',
        'face_verified_at',
        'gob_taxes',
        'sub_total',
        'total',
        'package_id',
        'user_id',
    ];

    public function package(){
        return $this->belongsTo(Package::class,'package_id','id');
    }
    public function order(){
        return $this->hasOne(Order::class,'visa_infos_id','id');
    }
}
