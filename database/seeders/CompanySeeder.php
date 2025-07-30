<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Company\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $companies = [
            [
                'name' => 'company',
                'email' => 'company@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'location_id' => 3,
                'status'    => 1,
                'slug'   => Str::slug('company'),
                'password' => Hash::make('123'),
                // 'password' => Hash::make('shashank'),
            ],

        ];

        foreach ($companies as $key => $value) {
            Company::create($value);
        }

        Company::all()->map(function ($company) {
            $company->assignRole($company->slug);
        });
    }

}
