<?php

namespace Database\Factories;

use App\Models\MealType;
use Illuminate\Database\Eloquent\Factories\Factory;


class MealTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MealType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'code' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'start' => $this->faker->date('H:i:s'),
            'end' => $this->faker->date('H:i:s'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
