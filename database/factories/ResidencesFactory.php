<?php

namespace Database\Factories;

use App\Models\Residences;
use Illuminate\Database\Eloquent\Factories\Factory;


class ResidencesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Residences::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'code' => $this->faker->text($this->faker->numberBetween(5, 30)),
            'wilaya' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'id_residence' => $this->faker->word,
            'denomination_fr' => $this->faker->text($this->faker->numberBetween(5, 250)),
            'denomination_ar' => $this->faker->text($this->faker->numberBetween(5, 250)),
            'dou' => $this->faker->text($this->faker->numberBetween(5, 250)),
            'type_residence' => $this->faker->text($this->faker->numberBetween(5, 255))
        ];
    }
}
