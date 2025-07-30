<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'guard_name' => 'admin',
                'name' => 'superadmin'
            ],
            [
                'guard_name' => 'admin',
                'name' => 'zoneadmin'
            ],
            [
                'guard_name' => 'admin',
                'name' => 'stateadmin'
            ],
            [
                'guard_name' => 'admin',
                'name' => 'cityadmin'
            ],
            [
                'guard_name' => 'admin',
                'name' => 'admin'
            ],
            [
                'guard_name' => 'admin',
                'name' => 'blogger'
            ],
            [
                'guard_name' => 'company',
                'name' => 'company',
            ],
            [
                'guard_name' => 'vendor',
                'name' => 'vendor',
            ],
            [
                'guard_name' => 'host',
                'name' => 'host',
            ],
            [
                'guard_name' => 'host',
                'name' => 'bride',
            ],
            [
                'guard_name' => 'host',
                'name' => 'groom'
            ],
            [
                'guard_name' => 'host',
                'name' => 'member',
            ],
            [
                'name' => 'guest',
                'guard_name' => 'web'
            ]
        ];

        foreach ($roles as $key => $value) {
            Role::Create($value);
        }
    }
}
