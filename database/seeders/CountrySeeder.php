<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\File;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::truncate();

        $json = File::get("database/data/country.json");
        $countries = json_decode($json, true);

        foreach ($countries as $country) {
            Country::create([
                "name" => $country['name'],
                "code" => $country['code'],
                "states" => $country['states']
            ]);
        }
    }
}
