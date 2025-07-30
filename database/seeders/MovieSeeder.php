<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/data/movies.json");
        $movies = json_decode($json, true);

        foreach ($movies as $movie) {
            Movie::query()->updateOrCreate([
                'title' => $movie['title'],
                'id_imdb' => $movie['id_imdb']
            ]);
        }
    }
}
