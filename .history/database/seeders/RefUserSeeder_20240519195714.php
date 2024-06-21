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
            'name' => 'Mochamad Al Fadilah Irwansyah',
            'phone_number' => '087887718940',
            'ref_role_id' => '1',
            'email' => ''
        ]);
    }
}
