<?php

namespace Database\Seeders;

use App\Models\Vendor\Service;
use Illuminate\Database\Seeder;
use App\Models\Admin\ServiceMaster;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceMaster::factory(50)->create();
    }
}
