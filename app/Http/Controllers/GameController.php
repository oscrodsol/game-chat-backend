<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{

    public function getAllGames()
    {
        try {
             $games = Game::query()->get(['title','description']);

            return response()->json([
                'success' => true,
                'message' => 'Games retrieved successfully',
                'data' => $games
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving ' . $exception->getMessage()
            ]);
        }
    }

    public function getAllGamesInfo()
    {
        try {
             $games = Game::query()->get();

            return response()->json([
                'success' => true,
                'message' => 'Games retrieved successfully',
                'data' => $games
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving ' . $exception->getMessage()
            ]);
        }
    }

    public function createGame(Request $request)
    {
        try {
            Log::info("Creating a game");

            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
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

            $title = $request->input('title');
            $description = $request->input('description');
            $userId = auth()->user()->id;

            $game = new Game();
            $game->title = $title;
            $game->user_id = $userId;
            $game->description = $description;

            $game->save();


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

     public function getGameByTitle(Request $request, $title)
    {

        try {
            $game = Game::query()->where('title', $title)->get();

            return response()->json([
                'success' => true,
                'message' => 'Games retrieved successfully',
                'data' => $game
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving ' . $exception->getMessage()
            ]);
        }
    } 

      public function deleteGameById($id)
    {
        try {
            Log::info('Delete game with the id ' . $id);

            $game = Game::find($id);

            if (!$game) {
                return response()->json([
                    'success' => false,
                    'message' => "The game doesn't exist"
                ], 200);
            }

            $game->delete();

            return response()->json([
                'success' => true,
                'message' => 'Game ' . $id . ' deleted successfully'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Updating game ' . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error deleting game'
            ], 500);
        }
    } 

     public function modifyGameById(Request $request, $id)
    {
        try {
            Log::info("Updating game");

            $game = Game::query()->where('id', $id)->first();

            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'description' => 'required|string',
                'status' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ]);
            }

            $title = $request->input('title');
            $description = $request->input('description');
            $status = $request->input('status');

            $game->title = $title;
            $game->description = $description;
            $game->status = $status;

            $game->save();

            return response()->json([
                'success' => true,
                'message' => 'Game ' . $id . ' updated successfully'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Updating game ' . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error updating game'
            ], 500);
        }
    } 
}
