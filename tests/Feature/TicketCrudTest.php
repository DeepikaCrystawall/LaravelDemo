<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Ticket;
use App\Models\User; // Import the User model
use App\Models\Product;
use App\Events\TicketCreation;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;

use PHPUnit\Framework\Attributes\Test;


class TicketCrudTest extends TestCase
{
    use WithFaker,RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a test user and authenticate them
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
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

    #[Test]
    public function it_creates_a_ticket_and_redirects_users_based_on_role()
    {
        // Prepare the necessary data
        $user = User::factory()->create(['role_id' => 1]); // Regular user
        $product = Product::factory()->create(); // Assuming you have a Product factory

        // Act as the user
        $this->actingAs($user);

        // Create the request data
        $data = [
            'title' => 'Test Ticket',
            'description' => 'Test Description',
            'product_id' => $product->id,
        ];

        // Send the request
        $response = $this->post(route('ticket.store'), $data);

        // Assert that the ticket was created
        $this->assertDatabaseHas('tickets', [
            'title' => 'Test Ticket',
            'description' => 'Test Description',
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        // Assert the correct redirect for regular user
        $response->assertRedirect(route('ticket.index'))
                 ->assertSessionHas('success', 'Ticket created successfully.');
    }

    #[Test]    
    public function it_stores_an_attachment_when_provided()
    {
        Storage::fake('attachments');

        // Prepare the necessary data
        $user = User::factory()->create(['role_id' => 1]);
        $product = Product::factory()->create();
        $file = UploadedFile::fake()->image('attachment.jpg');

        // Act as the user
        $this->actingAs($user);

        // Create the request data
        $data = [
            'title' => 'Test Ticket with Attachment',
            'description' => 'Test Description',
            'product_id' => $product->id,
            'attachment' => $file,
        ];

        // Send the request
        $response = $this->post(route('ticket.store'), $data);

        // Assert that the ticket was created
        $this->assertDatabaseHas('tickets', [
            'title' => 'Test Ticket with Attachment',
            'description' => 'Test Description',
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

       

    }

    #[Test]
     public function it_fires_the_ticket_creation_event()
    {
        // Fake the event
        Event::fake();

        // Prepare the necessary data
        $user = User::factory()->create(['role_id' => 1]);
        $product = Product::factory()->create();

        // Act as the user
        $this->actingAs($user);

        // Create the request data
        $data = [
            'title' => 'Event Test Ticket',
            'description' => 'Test Description',
            'product_id' => $product->id,
        ];

        // Send the request
        $response = $this->post(route('ticket.store'), $data);

        // Assert that the event was dispatched
        Event::assertDispatched(TicketCreation::class);
        
    }

    #[Test]
    public function it_redirects_users_to_my_account()
    {
        // Prepare the necessary data
        $user = User::factory()->create(['role_id' => 2]); //  user
        $product = Product::factory()->create();

        // Act as the user
        $this->actingAs($user);

        // Create the request data
        $data = [
            'title' => 'User Test Ticket',
            'description' => 'Test Description',
            'product_id' => $product->id,
        ];

        // Send the request
        $response = $this->post(route('ticket.store'), $data);
       
        // Assert the correct redirect for  user
        $response->assertRedirect(route('my-account', ['ticket' => 'ticket']))
                 ->assertSessionHas('success', 'Ticket created successfully');
    }

}
