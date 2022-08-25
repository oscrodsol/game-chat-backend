<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    const ROLE_USER = 1;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nick' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create([
            'nick' => $request->get('nick'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->password),

        ]);

        $user->roles()->attach(self::ROLE_USER);

        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user', 'token'), 201);
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
        ]);
    }

    public function modifyUser(Request $request)
    {
        $userId = auth()->user()->id;

        try {
            Log::info("Updating user");

            $user = User::find($userId);

            $validator = Validator::make($request->all(), [
                'nick' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ]);
            }

            $nick = $request->input('nick');


            $user->nick = $nick;

            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'User ' . $userId . ' updated successfully'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Updating user ' . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error updating users'
            ], 500);
        }
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        try {
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deleteUserById($id)
    {
        $userId = auth()->user()->id;
        try {
            Log::info('Delete user with the id ' . $id);

            $user = User::find($id)->where('user_id', $userId);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => "The user doesn't exist"
                ], 200);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'user ' . $id . ' deleted successfully'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Updating user ' . $exception->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error deleting users'
            ], 500);
        }
    }
}
