<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::applyFilters()
            ->applySorts()
            ->jsonPaginate();

        return MessageResource::collection($messages);
    }

    public function show(Message $message)
    {
        return MessageResource::make($message);
    }
}
