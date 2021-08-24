<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ApiController;
use App\Http\Controllers\ChatController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user',[UserController::class,'index']);
Route::get('/student',[UserController::class,'student']);
Route::get('/teacher',[UserController::class,'teacher']);


Route::prefix('/user')->group( function(){
        Route::post('/store',[UserController::class,'store']);
        Route::put('/{id}',[UserController::class,'update']);
        Route::delete('/{id}',[UserController::class,'destroy']);
    }
);

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', [ApiController::class,'login']);
    Route::post('/register',[ApiController::class,'register']);
    Route::post('/logout', [ApiController::class,'logout']);
    Route::get('/chat/rooms',[ChatController::class,'rooms']);
    Route::get('/chat/room/{roomId}/messages',[ChatController::class,'messages']);
    Route::post('/chat/room/{roomId}/message',[ChatController::class,'newMessage']);
});

Route::middleware(['auth:sanctum','verified'])->get('/chat', function () {
    return view('Chat/container');
})->name('chat');
