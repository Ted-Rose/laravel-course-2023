<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    use CanLoadRelationships;

    // Set relations field here to set default value for howl class.
    private array $relations = ['user', 'attendees', 'attendees.user'];

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        // Possible relations to control what can be loaded
        $relations = ['user', 'attendees', 'attendees.user'];
        // Start query builder by pointing to the method
        // that has been added by trait.
        $query = $this->CanLoadRelationships(Event::query(), $relations);

        // // Also works:
        // $query = $this->CanLoadRelationships(Event::query());

        // Add user relationship in order to show user for each event.
        // Also EventResource has to be updated.
        return EventResource::collection(
          // // We already have the query so lets call it. Lets add also
          // // latest to call from latest events.
            $query->latest()->paginate()
        );
    }
    
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
        // return $event;
        return new EventResource($this->CanLoadRelationships($event));

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
      // return $event;

      // No longer needed $event as CanLoadRelationships
      // method is passed into this object
      // // Load the user and attendees to return user
      // // and attendees for the specific event
      // $event->load('user', 'attendees');

      return new EventResource($this->CanLoadRelationships($event));
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

        return new EventResource($this->CanLoadRelationships($event));
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
