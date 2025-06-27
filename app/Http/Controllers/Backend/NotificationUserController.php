<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotificationSend;
use App\Models\User;
use Auth;
class NotificationUserController extends Controller
{
    public function userNotification(){
        $notifications =NotificationSend::with('user')->where('notified_to',Auth::user()->id)->get();
         $count=NotificationSend::where('notified_to',Auth::user()->id)->count();
        return response()->json([
            'notification'=>$notifications,
            'count'=>$count,
           
            'messege'=>'success'
        ]);
        
    }
}
