<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function postMessageByChannelId(Request $request, $id)
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

            Message::create([
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

    public function modifyMessageById(Request $request, $id)
    {

        $userId = auth()->user()->id;

        try {
            Log::info("Updating message");

            $messageUpdate = Message::query()->where('id', $id)->where('user_id', $userId)->first();

            $validator = Validator::make($request->all(), [
                'message' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ]);
            }

            $message = $request->input('message');

            $messageUpdate->message = $message;

            $messageUpdate->save();

            return response()->json([
                'success' => true,
                'message' => 'Message ' . $id . ' updated successfully'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Updating message ' . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error updating message'
            ], 500);
        }
    } 

    public function getAllMessagesByChannelId($id)
    {

        $userId = auth()->user()->id;

        try {
             $messages = Message::query()->where('channel_id', $id)->get();
             $channel = Channel::query()->findOrFail($id);
             $channel->users()->findOrFail($userId);

            return response()->json([
                'success' => true,
                'message' => 'Messages retrieved successfully',
                'data' => $messages
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving ' . $exception->getMessage()
            ]);
        }
    }

    public function deleteMessageById($id)
    {

        $userId = auth()->user()->id;

        try {

            Log::info('Delete message with the id ' . $id);

            $message = Message::query()->find($id)->where('user_id', $userId)->first();

            if (!$message) {
                return response()->json([
                    'success' => false,
                    'message' => "The message doesn't exist"
                ], 200);
            }

            $message->delete();

            return response()->json([
                'success' => true,
                'message' => 'message ' . $id . ' deleted successfully'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Updating message ' . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error deleting message'
            ], 500);
        }
    } 
}