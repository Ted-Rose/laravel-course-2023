<?php

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

// Previously we used resource method. apiResource method will
// register only those routes that are responsible for listing,
// showing one resource and directly modifying it without the
// routes for forms
Route::apiResource('events', EventController::class);
// Attendees don't exist on their own so lets point to EventAttendeeController
Route::apiResource('events.attendees', EventAttendeeController::class)
  // scoped means that attendee resources are always part of an event
  // so when using route model binding laravel will automatically load it
  // by looking parent event. So both attendee and event are requered.
  // If attendee is not attached to any event then laravel will throw error
  ->scoped(['attendee' => 'event']);