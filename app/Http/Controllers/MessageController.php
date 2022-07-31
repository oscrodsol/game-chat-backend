<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function postMessage(Request $request, $id)
    {

        $userId = auth()->user()->id;

        try {
            Log::info("Posting message");

            $validator = Validator::make($request->all(), [
                'message' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => $validator->errors()
                    ],
                    400
                );
            };

            $channel = Channel::query()->findOrFail($id);
            $channel->users()->findOrFail($userId);

            $channel = Message::create([
                'user_id' => $userId,
                'channel_id' => $id,
                'message' => $request->get('message'),

            ]);

            return response()->json(
                [
                    'success' => true,
                    'message' => "Message created"
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error("Error creating message: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error creating message"
                ],
                500
            );
        }
    }
}