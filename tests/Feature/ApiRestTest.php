<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiRestTest extends TestCase
{

    use RefreshDatabase;

    public function testGetAllClients()
    {
        $clients = Client::factory()->count(5)->create();

        $response = $this->get('/api/clients');

        $response->assertStatus(200)
            ->assertJsonCount(5) // 5 Clients
            ->assertJsonStructure([
                '*' => ['id', 'name', 'email', 'phone', 'address', 'services'],
            ]); 
    }

    public function testGetSingleClient()
    {
        $client = Client::factory()->create();

        $response = $this->get('/api/clients/' . $client->id);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'Client details',
                'client' => [
                    'id' => $client->id,
                    'name' => $client->name,
                    'email' => $client->email,
                    'phone' => $client->phone,
                    'address' => $client->address,
                ],
                'services' => $client->services,
            ]);

    }

    public function testCreateClient()
    {
        $clientData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
            'address' => '123 Main St',
        ];

        $response = $this->post('/api/clients', $clientData);

        $response->assertStatus(201); // Verifiqued client created

        $this->assertDatabaseHas('clients', $clientData); // Verifiqued in DB
    }

    public function testUpdateClient()
    {
        $client = Client::factory()->create();

        $updatedData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'phone' => '987654321',
            'address' => '456 New St',
        ];

        $response = $this->put('/api/clients/' . $client->id, $updatedData);

        $response->assertStatus(200); 

        $this->assertDatabaseHas('clients', $updatedData); 
    }

    public function testDeleteClient()
    {
        $client = Client::factory()->create();

        $response = $this->delete('/api/clients/' . $client->id);

        $response->assertStatus(204); 

        $this->assertDatabaseMissing('clients', ['id' => $client->id]); 
    }

    public function testAttachService()
    {
        $client = Client::factory()->create();
        $service = Service::factory()->create();

        $payload = [
            'client_id' => $client->id,
            'service_id' => $service->id,
        ];

        $response = $this->post('/api/clients/service', $payload);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Service attached successfully',
                'client' => [
                    'id' => $client->id,
                    'name' => $client->name,
                    // Others camps ..
                ],
            ]);
    }

    public function testDetachService()
    {
        $client = Client::factory()->create();
        $service = Service::factory()->create();

        $payload = [
            'client_id' => $client->id,
            'service_id' => $service->id,
        ];

        $response = $this->post('/api/clients/service/detach', $payload);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Service detach successfully',
                'client' => [
                    'id' => $client->id,
                    'name' => $client->name,
                ],
            ]); 
    }
}
