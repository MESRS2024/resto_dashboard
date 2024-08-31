<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Resto;

class RestoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_resto()
    {
        $resto = Resto::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/restos', $resto
        );

        $this->assertApiResponse($resto);
    }

    /**
     * @test
     */
    public function test_read_resto()
    {
        $resto = Resto::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/restos/'.$resto->id
        );

        $this->assertApiResponse($resto->toArray());
    }

    /**
     * @test
     */
    public function test_update_resto()
    {
        $resto = Resto::factory()->create();
        $editedResto = Resto::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/restos/'.$resto->id,
            $editedResto
        );

        $this->assertApiResponse($editedResto);
    }

    /**
     * @test
     */
    public function test_delete_resto()
    {
        $resto = Resto::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/restos/'.$resto->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/restos/'.$resto->id
        );

        $this->response->assertStatus(404);
    }
}
