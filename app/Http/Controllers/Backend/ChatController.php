<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // get data user
        $user = Auth::user();

        // get all data chat
        $listChats = Chat::where('sender_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get()
                    ->groupBy('recipient_id');

        $latestChats = collect();
        foreach ($listChats as $chats) {
            $latestChats->push($chats->last());
        }

        return view('backend.chat.index', compact('latestChats'));

    }

    public function person($id)
    {
        // get data user
        $user = Auth::user();

        // get data user yang dituju
        $recipient = User::findOrFail($id);

        // get all data chat
        $chats = Chat::where(function($query) use ($user, $recipient) {
                            $query->where('sender_id', $user->id)
                                ->where('recipient_id', $recipient->id);
                        })->orWhere(function($query) use ($user, $recipient) {
                            $query->where('sender_id', $recipient->id)
                                ->where('recipient_id', $user->id);
                        })->orderBy('created_at', 'ASC')->get();

        return view('backend.chat.person', compact('chats', 'recipient'));
    }

    public function send(Request $request)
    {
        $admin = Auth::user();
        $user = Auth::user()->role('user')->first();
        $chat = new Chat;
        $chat->message = $request->message;
        $chat->sender_id = $admin->id;
        $chat->recipient_id = $user->id;
        $chat->save();
        return response()->json(['success' => true]);
    }

    public function deleteAll()
    {
        $user = Auth::user();

        if (Auth::check()) {
            $chats = Chat::where('sender_id', $user->id)
            ->orWhere('recipient_id', '!=', $user->id)
            ->delete();

            return response()->json(['success' => true]);
        }
    }
}
