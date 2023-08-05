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
        return view('backend.chat.index');
    }

    public function list(Request $request) {
        $user = Auth::user();

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

        $listView = view('backend.chat.list', compact('latestChats', 'users'))->render();

        $data = [
            'listView' => $listView,
        ];

        return response()->json($data);
    }

    public function new()
    {
        // get data users
        $users = User::all();

        $listUser = view('backend.chat.new', compact('users'))->render();

        $data = [
            'listUser' => $listUser,
        ];

        return response()->json($data);
    }

    public function person($id)
    {
        // get data user
        $user = Auth::user();

        // get data user yang dituju
        $recipient = User::findOrFail($id);

        return view('backend.chat.person', compact('recipient'));
    }

    public function content($id)
    {
        // get data user
        $user = Auth::user();

        // get data user yang dituju
        $recipient = User::findOrFail($id);

        $reads = Chat::where('recipient_id', $user->id)
                        ->where('sender_id', $recipient->id)
                        ->where('status', 'unread')
                        ->update(['status' => 'read']);

        // get all data chat
        $chats = Chat::where(function($query) use ($user, $recipient) {
                            $query->where('sender_id', $user->id)
                                ->where('recipient_id', $recipient->id);
                        })->orWhere(function($query) use ($user, $recipient) {
                            $query->where('sender_id', $recipient->id)
                                ->where('recipient_id', $user->id);
                        })->orderBy('created_at', 'ASC')->get();


        $content = view('backend.chat.content', compact('chats'))->render();
        return response()->json(['content' => $content]);
    }

    public function send(Request $request)
    {
        $admin = Auth::user();
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
