<?php

namespace Tests\Repositories;

use App\Models\Resto;
use App\Repositories\RestoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RestoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected RestoRepository $restoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->restoRepo = app(RestoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_resto()
    {
        $resto = Resto::factory()->make()->toArray();

        $createdResto = $this->restoRepo->create($resto);

        $createdResto = $createdResto->toArray();
        $this->assertArrayHasKey('id', $createdResto);
        $this->assertNotNull($createdResto['id'], 'Created Resto must have id specified');
        $this->assertNotNull(Resto::find($createdResto['id']), 'Resto with given id must be in DB');
        $this->assertModelData($resto, $createdResto);
    }

    /**
     * @test read
     */
    public function test_read_resto()
    {
        $resto = Resto::factory()->create();

        $dbResto = $this->restoRepo->find($resto->id);

        $dbResto = $dbResto->toArray();
        $this->assertModelData($resto->toArray(), $dbResto);
    }

    /**
     * @test update
     */
    public function test_update_resto()
    {
        $resto = Resto::factory()->create();
        $fakeResto = Resto::factory()->make()->toArray();

        $updatedResto = $this->restoRepo->update($fakeResto, $resto->id);

        $this->assertModelData($fakeResto, $updatedResto->toArray());
        $dbResto = $this->restoRepo->find($resto->id);
        $this->assertModelData($fakeResto, $dbResto->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_resto()
    {
        $resto = Resto::factory()->create();

        $resp = $this->restoRepo->delete($resto->id);

        $this->assertTrue($resp);
        $this->assertNull(Resto::find($resto->id), 'Resto should not exist in DB');
    }
}
