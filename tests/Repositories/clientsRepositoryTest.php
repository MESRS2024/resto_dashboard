<?php

namespace Tests\Repositories;

use App\Models\clients;
use App\Repositories\clientsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class clientsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    protected clientsRepository $clientsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->clientsRepo = app(clientsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_clients()
    {
        $clients = clients::factory()->make()->toArray();

        $createdclients = $this->clientsRepo->create($clients);

        $createdclients = $createdclients->toArray();
        $this->assertArrayHasKey('id', $createdclients);
        $this->assertNotNull($createdclients['id'], 'Created clients must have id specified');
        $this->assertNotNull(clients::find($createdclients['id']), 'clients with given id must be in DB');
        $this->assertModelData($clients, $createdclients);
    }

    /**
     * @test read
     */
    public function test_read_clients()
    {
        $clients = clients::factory()->create();

        $dbclients = $this->clientsRepo->find($clients->id);

        $dbclients = $dbclients->toArray();
        $this->assertModelData($clients->toArray(), $dbclients);
    }

    /**
     * @test update
     */
    public function test_update_clients()
    {
        $clients = clients::factory()->create();
        $fakeclients = clients::factory()->make()->toArray();

        $updatedclients = $this->clientsRepo->update($fakeclients, $clients->id);

        $this->assertModelData($fakeclients, $updatedclients->toArray());
        $dbclients = $this->clientsRepo->find($clients->id);
        $this->assertModelData($fakeclients, $dbclients->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_clients()
    {
        $clients = clients::factory()->create();

        $resp = $this->clientsRepo->delete($clients->id);

        $this->assertTrue($resp);
        $this->assertNull(clients::find($clients->id), 'clients should not exist in DB');
    }
}
