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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  
        $request->validate([
          // If in validation any error occurs the user will be
          // redirected to the previous page (Laravel starting page
          // for example)
          'name' => 'required|string|max:255',
          'description' => 'nullable|string',
          'start_time' => 'required|date',
          // End date should be after the start_date
          'end_time' => 'required|date|after:start_time',
        ]);

        $event = Event::create([
          // !!!! Event requires the user column to be set, but
          // since we have some users loaded we will for now
          // set all created events by default to be assocaited
          // to user_id 1
          'user_id' => 1,
          'name' => $request->name,
          'description' => $request->description,
          'start_time' => $request->start_time,
          'end_time' => $request->end_time,          
        ]); 
        
        return $event;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
