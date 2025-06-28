<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Events\ChatEvent;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class ChatController extends Controller
{
    public function SendMessege(Request $request){
        // dd($request->all());
        $senderId=Auth::user()->id;
        $receiverId =$request->receiver_id;

        $conversationId  = min($senderId, $receiverId) . '-' . max($senderId, $receiverId);

        $messeges = new Chat();
        $messeges->sender_id=$senderId;
        $messeges->receiver_id=$receiverId;
        $messeges->conversation_id=$conversationId;
        $messeges->message=$request->messege ;
        $messeges->save();
        broadcast(new ChatEvent($messeges));
        return response()->json(['success' =>"Message sent successfully"]);
    }

    public function chatuser($friendId){
        $receiverId =$friendId;
        $users=User::all();
        return view('Backend.Layouts.Chat.chat',compact('receiverId','users'));
    }







    public function chat($conversationId)
{
    $messages = Chat::where('conversation_id', $conversationId)
                    ->orderBy('created_at', 'asc')
                    ->get();

    return response()->json(['chat' => $messages]);
}

 public function getNotification(){
         $user_id = Auth::user()->id;

    // প্রথমে latest message id per conversation group করি
    $latestMessages =DB::table('chats')
        ->select(DB::raw('MAX(id) as latest_id'))
        ->where(function($query) use ($user_id) {
            $query->where('sender_id', $user_id)
                  ->orWhere('receiver_id', $user_id);
        })
        ->groupBy('conversation_id');

    // তারপর ওই id গুলা নিয়ে full message details নিই
    $messages =Chat::with(['sender', 'receiver'])
        ->whereIn('id', $latestMessages->pluck('latest_id'))
        ->orderBy('created_at', 'desc')
        ->get();


    return response()->json(['messsegs' => $messages]);
    }

}
