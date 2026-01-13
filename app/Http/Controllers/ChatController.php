<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\ChatSession;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'session_id' => 'required',
            'name' => 'required',
            'email' => 'required|email'
        ]);

        return ChatSession::updateOrCreate(
            ['session_id' => $request->session_id],
            ['name' => $request->name, 'email' => $request->email]
        );
    }
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'session_id' => 'required'
        ]);

        $message = Message::create([
            'session_id' => $request->session_id,
            'message' => $request->message,
            'is_admin' => false // Messages from endpoint are from users
        ]);

        broadcast(new MessageSent($message));

        return response()->json(['status' => 'Message Sent!', 'message' => $message]);
    }

    public function reply(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'session_id' => 'required'
        ]);

        $message = Message::create([
            'session_id' => $request->session_id,
            'message' => $request->message,
            'is_admin' => true // Admin replies
        ]);

        broadcast(new MessageSent($message));

        return response()->json(['status' => 'Reply Sent!', 'message' => $message]);
    }
    
    public function fetchMessages(Request $request) {
        $sessionId = $request->query('session_id');
        return Message::where('session_id', $sessionId)->get();
    }
}
