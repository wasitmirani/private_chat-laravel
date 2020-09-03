<?php

namespace App\Http\Controllers\Api;

use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    //

    public function get_messages(Request $request){
        $privateCommunication= Message::with('user')
        ->where(['sender_id'=>  $request->auth_user, 'receiver_id'=> $request->receiver_id])
        ->orWhere(function($query) use($request){
            $query->where(['sender_id' => $request->receiver_id, 'receiver_id' =>$request->auth_user]);
        })
        ->get();


        return response()->json($privateCommunication);
    }

    public function send_message(Request $request){
        Message::create(
            [
            'sender_id'=>  $request->auth_user,
            'receiver_id'=> $request->receiver_id,
            'message'=>$request->message,

            ]
            );
    }
}
