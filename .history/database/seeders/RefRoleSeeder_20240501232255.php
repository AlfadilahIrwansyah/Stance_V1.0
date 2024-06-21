<?php

namespace Database\Seeders;

use App\Models\RefRole;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RefRoleSeeder extends Seeder
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
            RefRole::factory()->create([
                'role_name' => $name,
                'role_access' => 'ALL'
            ]);
        }
    }
}
