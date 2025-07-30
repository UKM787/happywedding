<?php

namespace Database\Seeders;

use App\Models\Host\Invitation;
use Illuminate\Database\Seeder;

class InvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invitation::factory()->create(['host_id' => 1, 'slug' => 'sita-weds-ram-by-host1','location_id' => '1']);
    }
}
