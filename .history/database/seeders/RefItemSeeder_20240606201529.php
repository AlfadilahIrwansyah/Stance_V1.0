<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accessNames = ['admin', 'cashier', 'owner', 'accounting'];

        foreach ($accessNames as $name) {
            Refi::factory()->create([
                'ROLE_NAME' => $name,
                'role_access' => 'ALL'
            ]);
        }
    }
}
