<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
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
        $user = Message::create([
            'nick' => $request->get('nick'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->password),

        ]);
    }
}
