<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $currentUserId = Auth::id();
        $users = User::query()->where('id', '!=', $currentUserId)->get(); // Получаем всех пользователей, кроме текущего
        return view('chat.index', compact('users'));
    }

    public function getMessages($id)
    {
        $messages = Message::query()->where('chat_id', $id)->with('user')->get();
        return response()->json(['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'recipient_id' => 'required|exists:users,id',
        ]);

        // Находим или создаем чат между двумя пользователями
        $chat = Chat::query()->where(function ($query) use ($validated) {
            $query->where('user_one', auth()->id())
                ->where('user_two', $validated['recipient_id']);
        })->orWhere(function ($query) use ($validated) {
            $query->where('user_one', $validated['recipient_id'])
                ->where('user_two', auth()->id());
        })->first();

        // Если чат не найден, создаем новый
        if (!$chat) {
            $chat = Chat::query()->create([
                'user_one' => auth()->id(),
                'user_two' => $validated['recipient_id'],
            ]);
        }

        // Создаем сообщение
        $message = new Message();
        $message->chat_id = $chat->id;
        $message->user_id = auth()->id();
        $message->message = $validated['message'];
        $message->save();

        // Отправка события
        broadcast(new MessageSent($request->user(), $message))->toOthers();

        return response()->json(['message' => 'Message sent successfully']);
    }
}
