<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
class ChatController extends Controller
{
    protected $userId;

    /**
     * Construct the controller.
     *
     * @param  \Illuminate\Contracts\Auth\Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->userId = $auth->id();
    }

    public function rooms(Request $request) {
        return ChatRoom::all();
    }

    public function messages(Request $request, $roomId) {
        return ChatMessage::where('chat_room_id',$roomId)
            ->with('user')
            ->orderBy('created_at','DESC')
            ->get();
    }

    public function newMessage(Request $request, $roomId) {
        $newMessage = new ChatMessage();
        $newMessage->user_id = $request->user;
        $newMessage->chat_room_id = $roomId;
        $newMessage->message = $request->message;
        $newMessage->save();

        return $newMessage;
    }
}
