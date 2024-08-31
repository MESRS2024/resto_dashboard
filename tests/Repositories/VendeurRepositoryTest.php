<?php

namespace Tests\Repositories;

use App\Models\Vendeur;
use App\Repositories\VendeurRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class VendeurRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected VendeurRepository $vendeurRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->vendeurRepo = app(VendeurRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_vendeur()
    {
        $vendeur = Vendeur::factory()->make()->toArray();

        $createdVendeur = $this->vendeurRepo->create($vendeur);

        $createdVendeur = $createdVendeur->toArray();
        $this->assertArrayHasKey('id', $createdVendeur);
        $this->assertNotNull($createdVendeur['id'], 'Created Vendeur must have id specified');
        $this->assertNotNull(Vendeur::find($createdVendeur['id']), 'Vendeur with given id must be in DB');
        $this->assertModelData($vendeur, $createdVendeur);
    }

    /**
     * @test read
     */
    public function test_read_vendeur()
    {
        $vendeur = Vendeur::factory()->create();

        $dbVendeur = $this->vendeurRepo->find($vendeur->id);

        $dbVendeur = $dbVendeur->toArray();
        $this->assertModelData($vendeur->toArray(), $dbVendeur);
    }

    /**
     * @test update
     */
    public function test_update_vendeur()
    {
        $vendeur = Vendeur::factory()->create();
        $fakeVendeur = Vendeur::factory()->make()->toArray();

        $updatedVendeur = $this->vendeurRepo->update($fakeVendeur, $vendeur->id);

        $this->assertModelData($fakeVendeur, $updatedVendeur->toArray());
        $dbVendeur = $this->vendeurRepo->find($vendeur->id);
        $this->assertModelData($fakeVendeur, $dbVendeur->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_vendeur()
    {
        $vendeur = Vendeur::factory()->create();

        $resp = $this->vendeurRepo->delete($vendeur->id);

        $this->assertTrue($resp);
        $this->assertNull(Vendeur::find($vendeur->id), 'Vendeur should not exist in DB');
    }
}
