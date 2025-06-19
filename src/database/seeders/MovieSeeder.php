<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/MovieSeeder.php
public function run()
{
    Movie::factory()->count(50)->create()->each(function ($movie) {
        Review::factory()->count(rand(3, 10))->create([
            'movie_id' => $movie->id,
            'rating' => rand(1, 5),
        ]);
    });
}

}
