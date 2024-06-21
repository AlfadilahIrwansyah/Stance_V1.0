<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RefAccessSeeder::class);
        // $this->call(RefRoleSeeder::class);
        $this->call(RefUserSeeder::class);
        $this->call(RefCategorySeeder::class);
    }
}
