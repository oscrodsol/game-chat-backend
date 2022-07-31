<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ChannelController extends Controller
{
    public function createChannel(Request $request)
    {
        try {
            Log::info("Creating a channel");

            $validator = Validator::make($request->all(), [
                'game_id' => 'required|integer',
                'channel_name' => 'required|string',
                'description' => 'required|string',
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

            $channel = Channel::create([
                'game_id' => $request->get('game_id'),
                'channel_name' => $request->get('channel_name'),
                'description' => $request->get('description'),

            ]);

            $channel->users()->attach(auth()->user()->id);

            return response()->json(
                [
                    'success' => true,
                    'message' => "Game created"
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error("Error creating game: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error creating Game"
                ],
                500
            );
        }
    }

    public function joinChannel (Request $request, $id)
    {
        try {
            $channel = Channel::query()->findOrFail($id);
            $channel->users()->attach(auth()->user()->id);

            return response()->json([
                'success' => true,
                'message' => 'user joined successfully',
                'data' => $channel
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Error joining channel ' . $exception->getMessage()
            ]);
        }
        return ['Get task with the id ' . $id];
    }
}
