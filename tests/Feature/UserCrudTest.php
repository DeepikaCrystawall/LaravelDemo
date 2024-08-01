<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserCrudTest extends TestCase
{
    use RefreshDatabase,WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a test user and authenticate them
        $this->user = User::factory()->create(['role_id' => 1]);
        $this->actingAs($this->user);
    }  
    /**
     * A basic feature test example.
     */
    #[Test]
   public function it_can_list_users()
   {
    // Create and log in a user
   // Create an admin user and log them in
  // $adminUser = User::factory()->create(['role_id' => 1]); // Assuming role_id 1 is for admin
  // $this->actingAs($adminUser);

      $users = User::factory()->count(5)->create(['role_id'=>2]);
      $admin = User::factory()->create(['role_id' => 1]);

      $response = $this->get('/users');
      $response->assertStatus(200);
      //$response->assertViewHas('users', $users);   
      $response->assertViewIs('users.list')  
      ->assertViewHas('title', 'Users')

      ->assertViewHas('users', function ($viewUsers) use ($users, $admin) {
     
         // Convert the collections to arrays of IDs
         $expectedUserIds = $users->pluck('id')->toArray();
         $viewUserIds = $viewUsers->pluck('id')->toArray();

         // Assert that all expected user IDs are present in the view data
         $allExpectedUsersPresent = !array_diff($expectedUserIds, $viewUserIds);
         
         // Assert that the admin user is not present in the view data
         $adminNotPresent = !in_array($admin->id, $viewUserIds);

         return $allExpectedUsersPresent && $adminNotPresent;
    });

   }

   #[Test]

   public function it_can_create_users()
   {
          $password = Hash::make(Str::random(6));
     
           // Create the request data
           $data = [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => $password,
            'role_id'=>2,
            'remember_token' => Str::random(10),
        ];

        // Send the request
        $response = $this->post(route('users.store'), $data);

        // Assert the correct redirect for regular user
        $response->assertRedirect(route('users.index'))
        ->assertSessionHas('success','User created successfully.');
   }
    #[Test]
   public function it_can_update_users()
   {
    $user = User::factory()->create(['role_id' => 2]);
    // Send the request
   // $response = $this->post(route('users.update'), $user->id);
   $updatedData = [
    'name'=>'Aby'
   ];
    $response = $this->put(route('users.update', $user->id,$updatedData));

    // Assert the correct redirect for regular user
    $response->assertRedirect(route('users.index'))
    ->assertSessionHas('success','Updated successfully.');

   }

   #[Test]
   public function it_can_delete_users()
   {
    $user = User::factory()->create(['role_id' => 2]);
    // Send the request
    $response = $this->delete(route('users.destroy', $user->id));
    // Assert the correct redirect for regular user
    $response->assertRedirect(route('users.index'))
    ->assertSessionHas('success','Deleted successfully.');
   }
   
}
