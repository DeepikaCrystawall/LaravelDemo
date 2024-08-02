<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;


class BlogCrudTest extends TestCase
{
    use RefreshDatabase,WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a test user and authenticate them
        $this->user = User::factory()->create(['role_id' => 1]);
        $this->actingAs($this->user);
    }

    #[Test]
    public function it_can_list_blogs()
    {
       // Create a test post
        $blogs = Post::factory()->create(['is_published'=>false]);
       
        $response = $this->get('/blogs');
        $response->assertStatus(200);
        $response->assertViewIs('frontend.blog')  
      ->assertViewHas('title', 'Blog | Luis N Vaya | Top Modular Kitchen Service Providers') 
      ->assertViewHas('posts', function ($viewPosts) use ($blogs) {
        
         // Ensure $viewPosts is an array and convert it to a collection if necessary
         $viewPosts = collect($viewPosts);

         // Ensure all posts are in the view data
         $viewPostsIds = $viewPosts->pluck('id')->toArray();
         $postsIds = $blogs->pluck('id')->toArray();

         return !array_diff($postsIds, $viewPostsIds);
    });      

    }

    #[Test]
    public function it_can_display_a_blog()
    {
       $blog = Post::factory()->create(['is_published'=> true]);
       $response = $this->get(route('show_blog', $blog->id));

       $response->assertStatus(200);
       $response->assertViewIs('frontend.show-blog');
       $response->assertViewHas('post', $blog);               

    }

}
