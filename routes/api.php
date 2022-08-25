<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function(){
    return 'Welcome!';
});

///////////////////////////////////////////////USER ENDPOINTS\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

Route::group(["middleware" => "jwt.auth"] , function() {
    Route::get('/profile', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']); 
    Route::put('/modify', [AuthController::class, 'modifyUser']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/////////////////////////////////////////////CHANNEL ENDPOINTS\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

Route::group(["middleware" => "jwt.auth"] , function() {
    Route::post('/create_channel', [ChannelController::class, 'createChannel']);
    Route::post('/join_channel/{id}', [ChannelController::class, 'joinChannel']);
    Route::post('/leave_channel/{id}', [ChannelController::class, 'leaveChannel']);
});

///////////////////////////////////////////////GAME ENDPOINTS\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

Route::group(["middleware" => ["jwt.auth", "isSuperAdmin"]] , function() {
    Route::post('/create_game', [GameController::class, 'createGame']);
    Route::delete('/delete_game/{id}', [GameController::class, 'deleteGameById']);
    Route::put('/update_game/{id}', [GameController::class, 'modifyGameById']);
});

Route::get('/games', [GameController::class, 'getAllGames']);
Route::get('/game_by_title/{title}', [GameController::class, 'getGameByTitle']);

////////////////////////////////////////////MESSAGE ENDPOINTS\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

Route::group(["middleware" => "jwt.auth"] , function() {
    Route::post('/message_by_channel_id/{id}', [MessageController::class, 'postMessageByChannelId']);
    Route::put('/update_message_by_id/{id}', [MessageController::class, 'modifyMessageById']);
    Route::get('/get_all_messages_by_channel_id/{id}', [MessageController::class, 'getAllMessagesByChannelId']);
    Route::delete('/delete_message_by_id/{id}', [MessageController::class, 'deleteMessageById']);
    Route::get('/get_message_by_id/{id}', [MessageController::class, 'getMessageById']);
});

//////////////////////////////////////////////ADMIN ENDPOINTS\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

Route::group(["middleware" => ["jwt.auth", "isSuperAdmin"]] , function() {
    Route::post('/user/add_super_admin/{id}', [AdminController::class, 'addSuperAdminRoleToUser']);
    Route::post('/user/remove_super_admin/{id}', [AdminController::class, 'removeSuperAdminRoleToUser']);
    Route::post('/user/add_admin/{id}', [AdminController::class, 'addAdminRoleToUser']);
    Route::post('/user/remove_admin/{id}', [AdminController::class, 'removeAdminRoleToUser']);
    Route::delete('/delete_user_by_id/{id}', [AuthController::class, 'deleteUserById']);
});