<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Message;

class MessageController extends Controller
{
    public function index(){
        $messages = Message::all();
        return response()->json(
            [
                'success' => true,
                'messages' => $messages
            ]
        );
    }
}
