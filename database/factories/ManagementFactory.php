<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ManagementFactory extends Factory
{
    protected $model = \App\Models\Management::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name(),
            'active'=> $this->faker->boolean()
        ];
    }
}
