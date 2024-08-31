<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Dfm;

class DfmApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_dfm()
    {
        $dfm = Dfm::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/dfms', $dfm
        );

        $this->assertApiResponse($dfm);
    }

    /**
     * @test
     */
    public function test_read_dfm()
    {
        $dfm = Dfm::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/dfms/'.$dfm->id
        );

        $this->assertApiResponse($dfm->toArray());
    }

    /**
     * @test
     */
    public function test_update_dfm()
    {
        $dfm = Dfm::factory()->create();
        $editedDfm = Dfm::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/dfms/'.$dfm->id,
            $editedDfm
        );

        $this->assertApiResponse($editedDfm);
    }

    /**
     * @test
     */
    public function test_delete_dfm()
    {
        $dfm = Dfm::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/dfms/'.$dfm->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/dfms/'.$dfm->id
        );

        $this->response->assertStatus(404);
    }
}
