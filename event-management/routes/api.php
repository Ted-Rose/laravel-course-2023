<?php

use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('events', EventController::class);
Route::apiResource('events.attendees', AttendeeController::class)
    // Removed "['attendee' => 'event']" for that caused error (see at the end
    // of the file)
    ->scoped()->except(['update']);

/* 
Error returned:
"message": "SQLSTATE[42S22]: Column not found: 1054 Unknown column 'event' in 'where clause' (Connection: mysql, SQL: select * from `attendees` where `attendees`.`event_id` = 10 and `attendees`.`event_id` is not null and `event` = 1822 limit 1)", */