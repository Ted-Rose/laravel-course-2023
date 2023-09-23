<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Http\Request;

class AttendeeController extends Controller
{
    public function index(Event $event)
    {
        $attendees = $event->attendees()->latest();

        return AttendeeResource::collection(
          $attendees->paginate()
        );
    }

    public function store(Request $request, Event $event)
    {   
      // Not only attendee will be created, but also automatically
      // set event_id to the Event model that is inputed in store method
        $attendee = $event->attendees()->create([
          // For now let's hard code the user_id
          'user_id' => 1
        ]);

        return new AttendeeResource($attendee);
    }

    public function show(Event $event, Attendee $attendee)
    {
        return new AttendeeResource($attendee);
    }

    // Only second input has to be type hinted as Attende. We don't
    // need event model fetched here for we don't use it. So we
    // don't unnecessarily fetch it.
    public function destroy(string $event, Attendee $attendee)
    {
      $attendee->delete();

      return response(status: 204);
    }
}
