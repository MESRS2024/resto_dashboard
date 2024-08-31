<?php

namespace Tests\Repositories;

use App\Models\Dfm;
use App\Repositories\DfmRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class DfmRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected DfmRepository $dfmRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->dfmRepo = app(DfmRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_dfm()
    {
        $dfm = Dfm::factory()->make()->toArray();

        $createdDfm = $this->dfmRepo->create($dfm);

        $createdDfm = $createdDfm->toArray();
        $this->assertArrayHasKey('id', $createdDfm);
        $this->assertNotNull($createdDfm['id'], 'Created Dfm must have id specified');
        $this->assertNotNull(Dfm::find($createdDfm['id']), 'Dfm with given id must be in DB');
        $this->assertModelData($dfm, $createdDfm);
    }

    /**
     * @test read
     */
    public function test_read_dfm()
    {
        $dfm = Dfm::factory()->create();

        $dbDfm = $this->dfmRepo->find($dfm->id);

        $dbDfm = $dbDfm->toArray();
        $this->assertModelData($dfm->toArray(), $dbDfm);
    }

    /**
     * @test update
     */
    public function test_update_dfm()
    {
        $dfm = Dfm::factory()->create();
        $fakeDfm = Dfm::factory()->make()->toArray();

        $updatedDfm = $this->dfmRepo->update($fakeDfm, $dfm->id);

        $this->assertModelData($fakeDfm, $updatedDfm->toArray());
        $dbDfm = $this->dfmRepo->find($dfm->id);
        $this->assertModelData($fakeDfm, $dbDfm->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_dfm()
    {
        $dfm = Dfm::factory()->create();

        $resp = $this->dfmRepo->delete($dfm->id);

        $this->assertTrue($resp);
        $this->assertNull(Dfm::find($dfm->id), 'Dfm should not exist in DB');
    }
}
