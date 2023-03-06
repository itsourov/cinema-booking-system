<?php

namespace Database\Factories;

use DateTime;
use Carbon\Carbon;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Show>
 */
class ShowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $movie =
            Movie::get()->random();
        return [
            'movie_id' => $movie->id,
            'title' => $movie->title . " Premier",
            'date' => Carbon::now()->addHours(rand(3, 12))->addMinute(rand(1, 59))->toDateTimeString(),
        ];
    }
}
