<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Ticket;
use App\Models\User; // Import the User model

use PHPUnit\Framework\Attributes\Test;


class TicketCrudTest extends TestCase
{
    use RefreshDatabase,WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a test user and authenticate them
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }


    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    #[Test]
    public function it_creates_a_ticket()
    {
        // Arrange: Prepare the data to be sent
        $data = [
            'title' => 'Sample Ticket',
            'description' => 'This is a sample ticket description.',
        ];

        // Act: Send a POST request to create the ticket
        //$response = $this->post('/tickets', $data);
        $response = $this->post(route('ticket.store'), $data);

        // Assert: Check the ticket was created and redirected
        $response->assertStatus(302); // Assuming redirection after create
       // $response->assertRedirect('/tickets');
        $response->assertRedirect(route('ticket.index'));

        $this->assertDatabaseHas('tickets', $data);
    }

    #[Test]

    public function it_displays_a_ticket()
    {
        // Arrange: Create a ticket
        $ticket = Ticket::factory()->create();

        // Act: Send a GET request to view the ticket
       // $response = $this->get('/tickets/' . $ticket->id);
        $response = $this->get(route('ticket.show', $ticket->id));


        // Assert: Check the response status and view
        $response->assertStatus(200);
        $response->assertViewHas('ticket', $ticket);
    }

    #[Test]

    public function it_updates_a_ticket()
    {
        // Arrange: Create a ticket
        $ticket = Ticket::factory()->create();
        $updatedData = [
            'title' => 'Updated Title',
            'description' => 'Updated description.',
        ];

        // Act: Send a PUT request to update the ticket
       // $response = $this->put('/tickets/' . $ticket->id, $updatedData);
        $response = $this->put(route('ticket.update', $ticket->id), $updatedData);


        // Assert: Check the ticket was updated and redirected
        $response->assertStatus(302); // Assuming redirection after update
       // $response->assertRedirect('/tickets');
        $response->assertRedirect(route('ticket.index'));

        $this->assertDatabaseHas('tickets', $updatedData);
        $this->assertDatabaseMissing('tickets', ['title' => $ticket->title]);
    }

    #[Test]
    public function it_deletes_a_ticket()
    {
        // Arrange: Create a ticket
        $ticket = Ticket::factory()->create();

        // Act: Send a DELETE request to delete the ticket
       // $response = $this->delete('/tickets/' . $ticket->id);
        $response = $this->delete(route('ticket.destroy', $ticket->id));

        // Assert: Check the ticket was deleted and redirected
        $response->assertStatus(302); // Assuming redirection after delete
       // $response->assertRedirect('/tickets');
        $response->assertRedirect(route('ticket.index'));


        $this->assertDatabaseMissing('tickets', ['id' => $ticket->id]);
    }

}
