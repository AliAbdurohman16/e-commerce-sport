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
        $user = Auth::user();

        // get all data chat
        $listChats = Chat::where('sender_id', $user->id)
                    ->orWhere('recipient_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->groupBy(function ($chat) use ($user) {
                        if ($chat->sender_id == $user->id) {
                            return $chat->recipient_id;
                        } else {
                            return $chat->sender_id;
                        }
                    });

        $latestChats = collect();
        foreach ($listChats as $chats) {
            $latestChats->push($chats->first());
        }

        $users = User::whereIn('id', $latestChats->pluck('sender_id'))
                ->orWhereIn('id', $latestChats->pluck('recipient_id'))
                ->get();

        return view('backend.chat.index', compact('latestChats', 'users'));
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
        // $user = Auth::user()->role('user')->first();
        $chat = new Chat;
        $chat->message = $request->message;
        $chat->sender_id = $admin->id;
        $chat->recipient_id = $request->recipient;
        $chat->save();
        return response()->json(['success' => true]);
    }

    public function deleteAll(Request $request)
    {
        $user = Auth::user();

        $chats = Chat::where(function($query) use ($user, $request) {
                        $query->where('sender_id', $user->id)
                            ->where('recipient_id', $request->recipient);
                    })
                    ->orWhere(function($query) use ($user, $request) {
                        $query->where('sender_id', $request->recipient)
                            ->where('recipient_id', $user->id);
                    })
                    ->delete();

        return response()->json(['success' => true]);
    }

}
