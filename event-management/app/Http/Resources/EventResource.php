<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
// Created by running in terminal:
// `php artisan make:resource EventResource`

// EventResource class is not in any way tied to
// event model or controller so these resource
// classes should be called explicitly.

// You can have many resource classes for one single
// model to serialize in different kind of outputs,
// or not to include some properties in some cases.
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        // Implements how specific resource should be
        // converted to JSON
        // return parent::toArray($request);

        // You can update the names of the attributes returned
        // and define which attributes are returned
        return [
          'id' => $this->id,
          'name' => $this->name,
          'description' => $this->description,
          'start_time' => $this->start_time,
          'end_time' => $this->end_time,

          // Building nested resources can reduce the number of queries
          // made to return data.
          // whenLoaded magical method is present on response if the
          // user relationship of particular event is loaded.
          // EventControler has to be updated in order to return user
          // for each event
          'user' => new UserResource($this->whenLoaded('user')),
          'attendees' => AttendeeResource::collection(
                $this->whenLoaded('attendees')
          )
        ];
    }
}
