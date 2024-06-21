<?php

namespace Database\Seeders;

use App\Models\RefCategory;
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
        $CategoryName = ['ELEKTRONIK', 'GAMING CONSOLE', 'MAKANAN', ''];

        foreach ($CategoryName as $name) {
            RefCategory::factory()->create([
                'CATEGORY_NAME' => $name
            ]);
        }
    }
}
