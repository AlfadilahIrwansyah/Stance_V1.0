<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefCategorySeeder extends Seeder
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
