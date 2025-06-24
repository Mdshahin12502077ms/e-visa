<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Smtp extends Model
{
    protected $fillable=[
        'app_name',
        'mail_mailer',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'mail_from_address',
    ];
}
