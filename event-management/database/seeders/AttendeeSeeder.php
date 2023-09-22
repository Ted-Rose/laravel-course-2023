<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::all();
        $events = \App\Models\Event::all();

        // Make every user attend random events
        foreach ($users as $user) {
          $eventstoAttend = $events->random(rand(1,3));
          
          foreach ($eventstoAttend as $event) {
            \App\Models\Attendee::create([
              // Take user_id as we itterate over all the users
              'user_id' => $user->id,
              // Assign event_id from randomly created event
              'event_id' => $event->id
            ]);
          }
        }
    }
}
