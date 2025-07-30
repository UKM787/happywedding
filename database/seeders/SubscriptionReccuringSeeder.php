<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use App\Models\Host\SubscriptionReccuringHost;

class SubscriptionReccuringSeeder extends Seeder
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
            'name'=> 'Free Plan',
            'plan_id' => 'plan_free001',
            'price' => 0,
            'color' => "background-color:green;",
        ],
        [
            'name'=> '7 days Plan',
            'plan_id' => 'plan_LPK8VfdSyySrOU',
            'price' => 20,
            'color' => "background-color:#ffb300;",
        ],
       ];

       foreach ($tags as $key => $value){
           SubscriptionReccuringHost::create($value);
       }

    }

}
