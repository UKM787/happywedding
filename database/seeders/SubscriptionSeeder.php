<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use App\Models\Host\SubscriptionHost;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $tags = [
        [
            'name'=> 'Free',
            'type' => 'host',
            'price' => 0,
            'color' => "background-color:#00A861;",
            'icon' => '/assets/shield.svg'
        ],
        // [
        //     'name'=> 'Bronze',
        //     'type' => 'host',
        //     'price' => 10,
        //     'color' => "background-color:#cd7f32;",
        //     'icon' => '/assets/shield.svg'
        // ],
        [
            'name'=> 'Silver',
            'type' => 'host',
            'price' => 20,
            'color' => "background-color:#4B9FD8;",
            'icon' => '/assets/silver-medal1.svg'
        ],
        [
            'name'=> 'Gold',
            'type' => 'host',
            'price' => 30,
            'color' => "background-color:#FAB711;",
            'icon' => '/assets/gold-medal.svg'
        ],
        [
            'name'=> 'Platinum',
            'type' => 'host',
            'price' => 40,
            'color' => "background-color:#B8B2B8;",
            'icon' => '/assets/platinum.svg'
        ],
        [
            'name'=> 'Diamond',
            'type' => 'host',
            'price' => 50,
            'color' => "background-color:#54C0EB;",
            'icon' => '/assets/diamond.svg'
        ],

       ];

       foreach ($tags as $key => $value){
           SubscriptionHost::create($value);
       }

    }

}
