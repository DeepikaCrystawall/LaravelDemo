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

        // Assert the user is redirected to the index route
        $response->assertRedirect(route('posts.index'));
    
    }

   #[Test]
   public function it_can_list_posts()
    {
        // Create a user and multiple posts
        //$user = User::factory()->create();
        Post::factory()->count(15)->create();

        // Make a GET request to the index route
        $response = $this->get(route('posts.index'));

        // Assert that the response status is OK
        $response->assertStatus(200);

        // Assert that the view is the expected one
        $response->assertViewIs('dashboard.posts.index');

        // Assert that the view has the 'posts' variable
        $response->assertViewHas('posts');

        // Assert that the posts are paginated
        $posts = $response->viewData('posts');
    }
}
