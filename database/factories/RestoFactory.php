<?php

namespace Database\Factories;

use App\Models\Resto;
use Illuminate\Database\Eloquent\Factories\Factory;


class RestoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resto::class;

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
            'password' => $this->faker->lexify('1???@???A???'),
            'is_active' => $this->faker->numberBetween(0, 9223372036854775807),
            'breakfast' => $this->faker->numberBetween(0, 9223372036854775807),
            'lunch' => $this->faker->numberBetween(0, 9223372036854775807),
            'dinner' => $this->faker->numberBetween(0, 9223372036854775807),
            'b_start' => $this->faker->date('H:i:s'),
            'b_end' => $this->faker->date('H:i:s'),
            'l_start' => $this->faker->date('H:i:s'),
            'l_end' => $this->faker->date('H:i:s'),
            'd_start' => $this->faker->date('H:i:s'),
            'd_end' => $this->faker->date('H:i:s'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
            'dou_code' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'resto_type' => $this->faker->word,
            'id_progres' => $this->faker->word
        ];
    }
}
