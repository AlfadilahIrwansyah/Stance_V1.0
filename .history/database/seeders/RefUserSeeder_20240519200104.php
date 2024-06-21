<?php

namespace Database\Seeders;

use App\Models\RefUser;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
            'email' => 'alfa@gmail.com',
            'password' => Hash::make('12345678'),
            'is_activated' => false,
            'created_at' => Carbon::now(),
            'update_at' => Carbon::now(),
        ]);
    }
}
