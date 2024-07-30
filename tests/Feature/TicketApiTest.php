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
use Illuminate\Testing\Fluent\AssertableJson;


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
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;
    
        $data = [
            'title' => 'Test Ticket Title',
            'description' => 'Test Ticket Description',
        ];
    
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/ticket', $data);
    
        $response->assertStatus(200);
    
        // Assert the JSON response structure and content
        $response->assertJson(function (AssertableJson $json) use ($data) {
            $json->where('success', true)
                 ->where('message', 'Ticket created successfully.')
                 ->has('data')
                 ->where('data.title', $data['title'])
                 ->where('data.description', $data['description'])
                 ->etc();
        });
    
        // Optionally, assert that the data was actually stored in the database
        $this->assertDatabaseHas('tickets', [
            'title' => $data['title'],
            'description' => $data['description'],
           // 'user_id' => $user->id,
        ]);
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
       // Create a user and a ticket to update
    $user = User::factory()->create();
    $ticket = Ticket::factory()->create(['user_id' => $user->id]);
    $token = $user->createToken('TestToken')->plainTextToken;

    // Define the updated data
    $updatedData = [
        'title' => 'Updated Title',
        'description' => 'Updated description.',
    ];

    // Send a PUT request to the API endpoint using the Sanctum token
    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->putJson('/api/ticket/' . $ticket->id, $updatedData);

    // Assert that the response status is 200 (OK)
    $response->assertStatus(Response::HTTP_OK);

   // dd($response->json());
    // Assert the JSON response structure and content
    $response->assertJson(function (AssertableJson $json) use ($ticket) {
       // dd($json);
        $json->where('success', true)
             ->where('message', 'Ticket Updated')
             ->has('data')
             ->where('data.title',$ticket->title)->etc();
    });

    // Optionally, assert that the data was actually updated in the database
    $this->assertDatabaseHas('tickets', [
        'title' => $updatedData['title'],
        'description' => $updatedData['description'],
        'id' => $ticket->id,
    ]);
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
