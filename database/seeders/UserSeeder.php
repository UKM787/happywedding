<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();
        $guests = [
            // [
            //     'name' => 'guest',
            //     'email' => 'guest@gmail.com',
            //     'email_verified_at' => now(),
            //     'mobile' =>  $faker->unique()->phoneNumber(),
            //     'status'    => 1,
            //     'slug'   => Str::slug('guest'),
            //     'password' => Hash::make('123'),
            //     // 'password' => Hash::make('shashank'),
            // ],
            [
                'name' => 'Guest User 1',
                'email' => 'guestuser1@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  '1111111111',
                'status' => 1,
                'slug'   => 'guest-user-1',
                'password' => bcrypt('123'),
                //'roles_user' => $host
            ],
            [
                'name' => 'Guest User 2',
                'email' => 'guestuser2@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  '1111111112',
                'status' => 1,
                'slug'   => 'guest-user-2',
                'password' => bcrypt('123'),
                //'roles_user' => $host
            ],
            [
                'name' => 'Guest User 3',
                'email' => 'guestuser3@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  '1111111113',
                'status' => 1,
                'slug'   => 'guest-user-3',
                'password' => bcrypt('123'),
                //'roles_user' => $host
            ],
            [
                'name' => 'Guest User 4',
                'email' => 'guestuser4@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  '1111111114',
                'status' => 1,
                'slug'   => 'guest-user-4',
                'password' => bcrypt('123'),
                //'roles_user' => $host
            ],
            [
                'name' => 'Guest User 5',
                'email' => 'guestuser5@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  '1111111115',
                'status' => 1,
                'slug'   => 'guest-user-5',
                'password' => bcrypt('123'),
                //'roles_user' => $host
            ],
            [
                'name' => 'Guest User 6',
                'email' => 'guestuser6@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  '1111111116',
                'status' => 1,
                'slug'   => 'guest-user-6',
                'password' => bcrypt('123'),
                //'roles_user' => $host
            ],
            [
                'name' => 'Guest User 7',
                'email' => 'guestuser7@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  '1111111117',
                'status' => 1,
                'slug'   => 'guest-user-7',
                'password' => bcrypt('123'),
                //'roles_user' => $host
            ],
            [
                'name' => 'Guest User 8',
                'email' => 'guestuser8@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  '1111111118',
                'status' => 1,
                'slug'   => 'guest-user-8',
                'password' => bcrypt('123'),
                //'roles_user' => $host
            ],
            [
                'name' => 'Guest User 9',
                'email' => 'guestuser9@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  '1111111119',
                'status' => 1,
                'slug'   => 'guest-user-9',
                'password' => bcrypt('123'),
                //'roles_user' => $host
            ],
            [
                'name' => 'Guest User 10',
                'email' => 'guestuser10@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  '1111111110',
                'status' => 1,
                'slug'   => 'guest-user-10',
                'password' => bcrypt('123'),
                //'roles_user' => $host
            ],
           /*  [
                'name' => 'guest1',
                'email' => 'guest1@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'active'    => 1,
                'slug'   => Str::slug('guest1'),
                'password' => Hash::make('123'),
                // 'password' => Hash::make('shashank'),
            ],
            [
                'name' => 'guest2',
                'email' => 'guest2@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'active'    => 1,
                'slug'   => Str::slug('guest2'),
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'guest3',
                'email' => 'guest3@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'active'    => 1,
                'slug'   => Str::slug('guest3'),
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'guest4',
                'email' => 'guest4@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'active'    => 1,
                'slug'   => Str::slug('guest4'),
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'guest5',
                'email' => 'guest5@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'active'    => 1,
                'slug'   => Str::slug('guest5'),
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'guest6',
                'email' => 'guest6@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'active'    => 1,
                'slug'   => Str::slug('guest6'),
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'guest7',
                'email' => 'guest7@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'active'    => 1,
                'slug'   => Str::slug('guest7'),
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'guest8',
                'email' => 'guest8@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'active'    => 1,
                'slug'   => Str::slug('guest8'),
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'guest9',
                'email' => 'guest9@gmail.com',
                'email_verified_at' => now(),
                'mobile' =>  $faker->unique()->phoneNumber(),
                'active'    => 1,
                'slug'   => Str::slug('guest9'),
                'password' => Hash::make('123'),
            ], */

        ];

        foreach ($guests as $key => $value) {
            User::create($value);
        }

        // User::all()->map(function ($user) {
        //     $user->assignRole($user->slug);
        // });
    }
}
