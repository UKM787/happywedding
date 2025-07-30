<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Support\Str;
use App\Models\Admin\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $admins = [
            [
                'name' => 'SuperAdmin',
                'email' => 'superadmin@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'status' => 1,
                'parent_id' => 0,
                'role' => 'superadmin',
                'slug'   => Str::slug('superadmin'),
                'password' => Hash::make('superadmin')
                // 'password' => bcrypt('123'),
            ],
            [
                'name' => 'ZoneAdmin',
                'email' => 'zoneadmin@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'status' => 1,
                'parent_id' => 0,
                'role' => 'zoneadmin',
                'slug'   => Str::slug('zoneadmin'),
                'password' => Hash::make('zoneadmin')
            ],
            [
                'name' => 'StateAdmin',
                'email' => 'stateadmin@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'status' => 1,
                'parent_id' => 0,
                'role' => 'stateadmin',
                'slug'   => Str::slug('stateadmin'),
                'password' => Hash::make('stateadmin')
            ],
            [
                'name' => 'CityAdmin',
                'email' => 'cityadmin@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'status' => 1,
                'parent_id' => 0,
                'role' => 'cityadmin',
                'slug'   => Str::slug('cityadmin'),
                'password' => Hash::make('cityadmin')
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  '9888046026',
                'status' => 1,
                'parent_id' => 0,
                'role' => 'admin',
                'slug'   => Str::slug('admin'),
                'password' => Hash::make('admin')
            ],
            [
                'name' => 'Blogger',
                'email' => 'blogger@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'status' => 1,
                'parent_id' => 0,
                'role' => 'blogger',
                'slug'   => Str::slug('blogger'),
                'password' => Hash::make('blogger')
            ],
        ];

        foreach ($admins as $key => $value) {
            $admin = Admin::create($value);
        }

        Admin::all()->each(function ($admin) {
            $admin->assignRole($admin->slug);
        });
    }
}
