<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MealType;

class MealTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_meal_type()
    {
        $mealType = MealType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/meal-types', $mealType
        );

        $this->assertApiResponse($mealType);
    }

    /**
     * @test
     */
    public function test_read_meal_type()
    {
        $mealType = MealType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/meal-types/'.$mealType->id
        );

        $this->assertApiResponse($mealType->toArray());
    }

    /**
     * @test
     */
    public function test_update_meal_type()
    {
        $mealType = MealType::factory()->create();
        $editedMealType = MealType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/meal-types/'.$mealType->id,
            $editedMealType
        );

        $this->assertApiResponse($editedMealType);
    }

    /**
     * @test
     */
    public function test_delete_meal_type()
    {
        $mealType = MealType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/meal-types/'.$mealType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/meal-types/'.$mealType->id
        );

        $this->response->assertStatus(404);
    }
}
