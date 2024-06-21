<?php

namespace Database\Seeders;

use App\Models\RefItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            RefItem::factory()->create([
                'ROLE_NAME' => $name,
                'role_access' => 'ALL'
            ]);
        }
    }
}
