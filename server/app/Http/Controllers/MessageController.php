<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        // Dispara o evento
        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message sent!']);
    }
}
