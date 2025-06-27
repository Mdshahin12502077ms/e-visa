<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationSend extends Model
{
    protected $fillable = [
        'title',
        'comment',
        'notified_to',
        'created_by',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'notified_to','id');
    }
}
