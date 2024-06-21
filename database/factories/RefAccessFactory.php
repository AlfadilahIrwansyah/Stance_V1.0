<?php

namespace Database\Factories;

use App\Models\RefAccess;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RefAccess>
 */
class RefAccessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = RefAccess::class;
    public function definition()
    {
        return [
            'access_name' => $this->faker->unique()->word,
        ];
    }
}
