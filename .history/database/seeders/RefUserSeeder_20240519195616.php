<?php

namespace Database\Seeders;

use App\Models\RefUser;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RefUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RefUser::factory()->create([
            'role_name' => $name,
            'role_access' => 'ALL'
        ]);
    }
}
