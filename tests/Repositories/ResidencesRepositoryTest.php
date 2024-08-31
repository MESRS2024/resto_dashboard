<?php

namespace Tests\Repositories;

use App\Models\Residences;
use App\Repositories\ResidencesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ResidencesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected ResidencesRepository $residencesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->residencesRepo = app(ResidencesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_residences()
    {
        $residences = Residences::factory()->make()->toArray();

        $createdResidences = $this->residencesRepo->create($residences);

        $createdResidences = $createdResidences->toArray();
        $this->assertArrayHasKey('id', $createdResidences);
        $this->assertNotNull($createdResidences['id'], 'Created Residences must have id specified');
        $this->assertNotNull(Residences::find($createdResidences['id']), 'Residences with given id must be in DB');
        $this->assertModelData($residences, $createdResidences);
    }

    /**
     * @test read
     */
    public function test_read_residences()
    {
        $residences = Residences::factory()->create();

        $dbResidences = $this->residencesRepo->find($residences->id);

        $dbResidences = $dbResidences->toArray();
        $this->assertModelData($residences->toArray(), $dbResidences);
    }

    /**
     * @test update
     */
    public function test_update_residences()
    {
        $residences = Residences::factory()->create();
        $fakeResidences = Residences::factory()->make()->toArray();

        $updatedResidences = $this->residencesRepo->update($fakeResidences, $residences->id);

        $this->assertModelData($fakeResidences, $updatedResidences->toArray());
        $dbResidences = $this->residencesRepo->find($residences->id);
        $this->assertModelData($fakeResidences, $dbResidences->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_residences()
    {
        $residences = Residences::factory()->create();

        $resp = $this->residencesRepo->delete($residences->id);

        $this->assertTrue($resp);
        $this->assertNull(Residences::find($residences->id), 'Residences should not exist in DB');
    }
}
