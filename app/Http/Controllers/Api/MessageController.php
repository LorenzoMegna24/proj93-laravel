<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewMessage;
use Illuminate\Http\Request;
use App\Models\Admin\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'apartment_id' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'mail' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors()
                ]
            );
        }

        $data['date'] = now()->setTimezone('Europe/Rome');;

        $new_message = Message::create($data);

        return response()->json(
            [
                'success' => true
            ]
        );
    }


    public function index()
    {
        $messages = Message::all();
        return response()->json(
            [
                'success' => true,
                'messages' => $messages
            ]
        );
    }
}
