<?php

namespace Tests\Repositories;

use App\Models\MealType;
use App\Repositories\MealTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MealTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected MealTypeRepository $mealTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->mealTypeRepo = app(MealTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_meal_type()
    {
        $mealType = MealType::factory()->make()->toArray();

        $createdMealType = $this->mealTypeRepo->create($mealType);

        $createdMealType = $createdMealType->toArray();
        $this->assertArrayHasKey('id', $createdMealType);
        $this->assertNotNull($createdMealType['id'], 'Created MealType must have id specified');
        $this->assertNotNull(MealType::find($createdMealType['id']), 'MealType with given id must be in DB');
        $this->assertModelData($mealType, $createdMealType);
    }

    /**
     * @test read
     */
    public function test_read_meal_type()
    {
        $mealType = MealType::factory()->create();

        $dbMealType = $this->mealTypeRepo->find($mealType->id);

        $dbMealType = $dbMealType->toArray();
        $this->assertModelData($mealType->toArray(), $dbMealType);
    }

    /**
     * @test update
     */
    public function test_update_meal_type()
    {
        $mealType = MealType::factory()->create();
        $fakeMealType = MealType::factory()->make()->toArray();

        $updatedMealType = $this->mealTypeRepo->update($fakeMealType, $mealType->id);

        $this->assertModelData($fakeMealType, $updatedMealType->toArray());
        $dbMealType = $this->mealTypeRepo->find($mealType->id);
        $this->assertModelData($fakeMealType, $dbMealType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_meal_type()
    {
        $mealType = MealType::factory()->create();

        $resp = $this->mealTypeRepo->delete($mealType->id);

        $this->assertTrue($resp);
        $this->assertNull(MealType::find($mealType->id), 'MealType should not exist in DB');
    }
}
