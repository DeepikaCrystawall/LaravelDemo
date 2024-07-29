<?php

namespace Tests\Feature;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\Attributes\Test;

class TicketApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    use RefreshDatabase,WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test user and authenticate with Sanctum
        $this->user = User::factory()->create();
        Sanctum::actingAs($this->user); // Authenticate using Sanctum
    }

    #[Test]
    public function it_can_list_tickets()
    {
       // Arrange: Create some tickets
    $tickets = Ticket::factory()->count(3)->create();
    $expectedData = $tickets->map(function ($ticket) {
        return [
            'id' => $ticket->id,
            'title' => $ticket->title,
            'description' => $ticket->description,
        ];
    })->toArray();

    // Act: Send a GET request to the API
    $response = $this->getJson('/api/ticket');

    // Assert: Check the response status and structure
    $response->assertStatus(Response::HTTP_OK)
             ->assertJson([
                 'success' => true,
                 'data'    => [
                     'data' => $expectedData,
                     'current_page' => 1,
                     'last_page' => 1,
                     'per_page' => 10,
                     'total' => count($tickets),
                 ],
                 'message' => 'Tickets Listed successfully',
             ]);
    }

    #[Test]
    public function it_can_create_a_ticket()
    {
         // Arrange: Define the data to send in the request
         $data = [
            'title' => 'New Ticket',
            'description' => 'Description for new ticket',
            'user_id' => auth()->id(),
        ];

        // Act: Send a POST request to create a new ticket
        $response = $this->postJson('/api/ticket', $data);

        // Assert: Check the response status and structure
        $response->assertStatus(Response::HTTP_CREATED)
                 ->assertJson([
                     'success' => true,
                     'data' => [
                         'title' => 'New Ticket',
                         'description' => 'Description for new ticket',
                         // Optionally include the 'user_id' if it is part of the response
                          'user_id' => auth()->id(),
                         // Include the 'id' field if it is returned in the response
                         // 'id' => 1, // This depends on your implementation
                     ],
                     'message' => 'Ticket created successfully.',
                 ]);

        // Assert the ticket was actually created in the database
        $this->assertDatabaseHas('tickets', [
            'title' => 'New Ticket',
            'description' => 'Description for new ticket',
            // Optionally include 'user_id' if relevant
             'user_id' => auth()->id(),
        ]);
       // $this->assertDatabaseHas('tickets', $data);
    }

    #[Test]
    public function it_can_show_a_ticket()
    {
        // Arrange: Create a ticket
        $ticket = Ticket::factory()->create();

        // Act: Send a GET request to show the ticket
        $response = $this->getJson('/api/ticket/' . $ticket->id);

        // Assert: Check the response status and data
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson([
                     'data' => [
                         'id' => $ticket->id,
                         'title' => $ticket->title,
                         'description' => $ticket->description,
                     ]
                 ]);
    }

    #[Test]
    public function it_can_update_a_ticket()
    {
        // Arrange: Create a ticket
        $ticket = Ticket::factory()->create();
        $updatedData = [
            'title' => 'Updated Title',
            'description' => 'Updated description.',
        ];

        // Act: Send a PUT request to update the ticket
        $response = $this->putJson('/api/ticket/' . $ticket->id, $updatedData);

        // Assert: Check the response status and updated data
        $response->assertStatus(Response::HTTP_OK)
                 ->assertJson([
                     'success' => true,                     
                     'data' => $updatedData,                        
                     
                     'message' => 'Tickets Updated',
                 ]);

        $this->assertDatabaseHas('tickets', $updatedData);
        $this->assertDatabaseMissing('tickets', ['title' => $ticket->title]);
    }

    #[Test]
    public function it_can_delete_a_ticket()
    {
        $ticket = Ticket::factory()->create();

        $response = $this->deleteJson('/api/ticket/' . $ticket->id);
    
        $response->assertStatus(Response::HTTP_NO_CONTENT);
    
        $this->assertDatabaseMissing('tickets', ['id' => $ticket->id]);
    }
}
