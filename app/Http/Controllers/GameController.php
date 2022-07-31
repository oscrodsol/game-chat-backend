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
        $userId = auth()->user()->id;
        try {
            // $tasks = Task::query()->where('user_id','=',$userId)->get()->toArray();

            $games = User::query()->find($userId)->games; //One to many 

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
        return ['Get game with the id ' . $userId];
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
                    'message' => "Task created"
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error("Error creating task: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error creating tasks"
                ],
                500
            );
        }
    }
/* 
    public function getTaskById($id)
    {

        $userId = auth()->user()->id;
        try {
            $tasks = Task::query()->findOrFail($userId)->where('user_id', $userId)->where('id', $id)->get()->toArray();

            return response()->json([
                'success' => true,
                'message' => 'Tasks retrieved successfully',
                'data' => $tasks
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving ' . $exception->getMessage()
            ]);
        }
        return ['Get task with the id ' . $id];
    }

    public function deleteTaskById($id)
    {
        $userId = auth()->user()->id;
        try {
            Log::info('Delete task with the id ' . $id);

            $task = Task::find($id)->where('id', $id)->where('user_id', $userId);

            if (!$task) {
                return response()->json([
                    'success' => false,
                    'message' => "The task doesn't exist"
                ], 200);
            }

            $task->delete();

            return response()->json([
                'success' => true,
                'message' => 'Task ' . $id . ' deleted successfully'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Updating task ' . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error deleting tasks'
            ], 500);
        }
    }

    public function modifyTaskById(Request $request, $id)
    {

        $userId = auth()->user()->id;
        try {
            Log::info("Updating task");

            // $task = Task::find($id)->where('id','=',$id)->where('user_id','=',$userId);

            $task = Task::query()->where('id', '=', $id)->where('user_id', '=', $userId)->first();

            // dd($task);

            $validator = Validator::make($request->all(), [
                'title' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ]);
            }

            $title = $request->input('title');
            $status = $request->input('status');

            $task->title = $title;
            $task->status = $status;
            // $task->user_id = $userId;

            $task->save();

            return response()->json([
                'success' => true,
                'message' => 'Task ' . $id . ' updated successfully'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Updating task ' . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error updating tasks'
            ], 500);
        }
    }

    public function getUserByIdTask($id)
    {
        try {
            $task = Task::query()->find($id);

            $user = $task->user;

            return response()->json([
                'success' => true,
                'message' => 'Tasks retrieved successfully',
                'data' => $user
            ]);
        } catch (\Exception $exception) {
            Log::error('Updating task ' . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error updating tasks'
            ], 500);
        }
    } */
}
