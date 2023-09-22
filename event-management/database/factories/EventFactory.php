<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use DateTime;
use DateTimeZone;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => fake()->unique()->sentence(3),
            'description' => fake()->text(),
            'start_time' => fake()->dateTime('now'),
            'end_time' => fake()->dateTime('+1 month'),
        ];
    }
}
