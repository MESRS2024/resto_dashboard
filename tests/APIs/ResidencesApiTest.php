<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Residences;

class ResidencesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_residences()
    {
        $residences = Residences::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/residences', $residences
        );

        $this->assertApiResponse($residences);
    }

    /**
     * @test
     */
    public function test_read_residences()
    {
        $residences = Residences::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/residences/'.$residences->id
        );

        $this->assertApiResponse($residences->toArray());
    }

    /**
     * @test
     */
    public function test_update_residences()
    {
        $residences = Residences::factory()->create();
        $editedResidences = Residences::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/residences/'.$residences->id,
            $editedResidences
        );

        $this->assertApiResponse($editedResidences);
    }

    /**
     * @test
     */
    public function test_delete_residences()
    {
        $residences = Residences::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/residences/'.$residences->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/residences/'.$residences->id
        );

        $this->response->assertStatus(404);
    }
}
