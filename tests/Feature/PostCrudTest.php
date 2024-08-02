<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;


class PostCrudTest extends TestCase
{
   protected function setUp():void
   {
    parent::setUp();
     // Create a test user and authenticate them
     $this->user = User::factory()->create(['role_id' => 1]);
     $this->actingAs($this->user);
   }

   
//    public function it_can_list_posts()
//    {
    
//         // Create some posts
//         $posts = Post::factory()->count(15)->create(['is_published'=>false]); // Adjust count as needed

//         // Define cache and pagination behavior
//         $posts = Cache::shouldReceive('remember')
//             ->once()
//             ->with('posts', 60, \Closure::class)
//             ->andReturn(Post::with('user')->latest()->paginate(10));

//         // Access the index route
//         $response = $this->get(route('posts.index',$posts)); // Adjust the route name as needed

//         $expectedData = $posts->map(function ($ticket) {
//             return [
//                 'id' => $ticket->id,
//                 'title' => $ticket->title,
//                 'description' => $ticket->description,
//             ];
//         })->toArray();
//         // Assert the response status and view
//         $response->assertStatus(200)
//             ->assertViewIs('dashboard.posts.index') // Ensure this matches your view file
//             // ->assertViewHas('posts', function ($viewPosts) use ($posts) {
//             //     // Ensure all posts are in the view data
//             //     //$viewPostsIds = $viewPosts->pluck('id')->toArray();
//             //    // $viewPosts =  collect($viewPosts);
//             //     $viewPostsIds = $viewPosts->pluck('id')->toArray();

//             //     $postsIds = $posts->pluck('id')->toArray();

//             //     return !array_diff($postsIds, $viewPostsIds);
//             // });

//             ->assertViewHas('posts',($posts));      
       
//    }

   #[Test]
   public function it_can_store_a_post()
    {
        // Fake the storage disk to handle file uploads
        //Storage::fake('public');

        // Prepare valid data for the post
        $data = [
            'title' => 'Test Post Title',
            'body' => 'This is a test post body.',
           // 'image' => UploadedFile::fake()->image('test-image.jpg'),
        ];

        // Perform the POST request
        $response = $this->post(route('posts.store'), $data);

        // // Assert the post was created
        // $this->assertDatabaseHas('posts', [
        //     'title' => 'Test Post Title',
        //     'body' => 'This is a test post body.',
        //     // Check if the slug is created correctly
        //     'slug' => Str::slug('Test Post Title'),
        // ]);

        // // Assert the image was stored
        // Storage::disk('public')->assertExists('images/test-image.jpg'); // Adjust path as per your logic

        // Assert the user is redirected to the index route
        $response->assertRedirect(route('posts.index'));

        // Assert the flash message is present
        $response->assertSessionHas('message', 'Post successfully added.');
    }
    #[Test]
    public function it_can_update_a_post()
    {
        // Fake the storage disk to handle file uploads
       // Storage::fake('public');

        // Create a post to be updated
        $post = Post::factory()->create([
            'title' => 'Old Title',
            'body' => 'Old body content.',
            //'image' => 'images/old-image.jpg',
        ]);

        // Prepare updated data for the post
        $data = [
            'title' => 'Updated Post Title',
            'body' => 'Updated post body.',
          //  'image' => UploadedFile::fake()->image('new-image.jpg'),
        ];

        // Perform the PUT request
        $response = $this->put(route('posts.update', $post->id), $data);

        // Assert the post was updated
        // $this->assertDatabaseHas('posts', [
        //     'id' => $post->id,
        //     'title' => 'Updated Post Title',
        //     'body' => 'Updated post body.',
        //     'slug' => Str::slug('Updated Post Title'),
        // ]);

        // Assert the old image is not present (if it was removed)
       // Storage::disk('public')->assertMissing('images/old-image.jpg');

        // Assert the new image is stored
       // Storage::disk('public')->assertExists('images/new-image.jpg');

        // Assert the user is redirected to the index route
        $response->assertRedirect(route('posts.index'));

        // Assert the flash message is present
        $response->assertSessionHas('message', 'Post successfully updated.');
    }
    #[Test]
    public function it_can_delete_a_post()
    {
        // Create a post to be deleted
        $post = Post::factory()->create();

        // Perform the DELETE request
        $response = $this->delete(route('posts.destroy', $post->id));

        // Assert the post was deleted
        // $this->assertDatabaseMissing('posts', [
        //     'id' => $post->id,
        // ]);

        // Assert the user is redirected to the index route
        $response->assertRedirect(route('posts.index'));
    
    }

   
}
