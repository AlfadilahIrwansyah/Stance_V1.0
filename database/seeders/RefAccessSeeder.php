<?php

namespace Database\Seeders;

use App\Models\RefAccess;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RefAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $accessNames = ['HOME', 'STORAGE', 'FINANCE', 'REGISTER'];

        foreach ($accessNames as $name) {
            RefAccess::factory()->create([
                'access_name' => $name
            ]);
        }
    }
}
