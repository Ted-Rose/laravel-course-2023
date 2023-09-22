<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Event::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event = Event::create([
            ...$request->validate([
            // If in validation any error occurs the user will be
            // redirected to the previous page (Laravel starting page
            // for example)
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'start_time' => 'required|date',
                // End date should be after the start_date
                'end_time' => 'required|date|after:start_time'
            ]),
            // !!!! Event requires the user column to be set, but
            // since we have some users loaded we will for now
            // set all created events by default to be assocaited
            // to user_id 1
            'user_id' => 1
        ]);
        return $event;
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
      return $event;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $event->update(
          $request->validate([
                'name' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'start_time' => 'sometimes|date',
                'end_time' => 'sometimes|date|after:start_time'
            ])
        );

        return $event;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        // When deleting resource we don't return it, because it
        // no longer exists
        return response()->json([
          'message' => 'Event deleted'
        ]);

        // You can also send a 204 response, but then no content
        // should be added to the body
        return response(status: 204);
    }
}
