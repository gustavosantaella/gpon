<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Provider;
class ModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
     
        return [
            'name'=>$this->faker->name(),
            'code'=>$this->faker->text(100),
            'provider_id'=>Provider::factory()
        ];
    }
}
