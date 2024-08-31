<?php

namespace Database\Factories;

use App\Models\Vendeur;
use Illuminate\Database\Eloquent\Factories\Factory;


class VendeurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendeur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'resto_id' => $this->faker->word,
            'name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'phone' => $this->faker->numerify('0##########'),
            'password' => $this->faker->lexify('1???@???A???'),
            'device_id' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'photo' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'ban' => $this->faker->numberBetween(0, 9223372036854775807),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
