<?php

namespace Database\Factories;

use App\Models\clients;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Resto;

class clientsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = clients::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $resto = Resto::first();
        if (!$resto) {
            $resto = Resto::factory()->create();
        }

        return [
            'resto_id' => $this->faker->word,
            'type' => $this->faker->word,
            'name' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'card' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
            'code' => $this->faker->text($this->faker->numberBetween(5, 255)),
            'duplicate' => $this->faker->numberBetween(0, 9223372036854775807),
            'progres_id' => $this->faker->word
        ];
    }
}
