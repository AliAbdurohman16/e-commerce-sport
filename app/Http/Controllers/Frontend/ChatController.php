<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $user = Auth::user();
        $customer_service = Auth::user()->role('customer_service')->first();
        $chat = new Chat;
        $chat->message = $request->message;
        $chat->sender_id = $user->id;
        $chat->recipient_id = $customer_service->id;
        $chat->save();
        return response()->json(['success' => true]);
    }

    public function deleteAll()
    {
        $user = Auth::user();

        if (Auth::check()) {
            $chats = Chat::where('sender_id', $user->id)
            ->orWhere('recipient_id', $user->id)
            ->delete();

            return response()->json(['success' => true]);
        }
    }

}
