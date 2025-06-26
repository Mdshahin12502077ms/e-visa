<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 use App\Events\NotificationUser;
class NotificationController extends Controller
{
    public function notification(){
        $message="hello";
        event(new NotificationUser($message));
        return  "success";
    }
}
