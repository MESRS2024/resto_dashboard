<?php

namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Vendeur;

class VendeurApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_vendeur()
    {
        $vendeur = Vendeur::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/vendeurs', $vendeur
        );

        $this->assertApiResponse($vendeur);
    }

    /**
     * @test
     */
    public function test_read_vendeur()
    {
        $vendeur = Vendeur::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/vendeurs/'.$vendeur->id
        );

        $this->assertApiResponse($vendeur->toArray());
    }

    /**
     * @test
     */
    public function test_update_vendeur()
    {
        $vendeur = Vendeur::factory()->create();
        $editedVendeur = Vendeur::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/vendeurs/'.$vendeur->id,
            $editedVendeur
        );

        $this->assertApiResponse($editedVendeur);
    }

    /**
     * @test
     */
    public function test_delete_vendeur()
    {
        $vendeur = Vendeur::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/vendeurs/'.$vendeur->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/vendeurs/'.$vendeur->id
        );

        $this->response->assertStatus(404);
    }
}
