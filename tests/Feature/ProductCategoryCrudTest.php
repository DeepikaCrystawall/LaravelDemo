<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;

class ProductCategoryCrudTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a test user and authenticate them
        $this->user = User::factory()->create(['role_id'=>1]);
        $this->actingAs($this->user);
    }  
    #[Test]
    public function it_list_category()
    {
        
        // Arrange: Create a product
        $category = Category::factory()->create();
      
      
        // Act: Send a GET request to view the product
        $response = $this->get(route('category.index'));
 
        // Assert: Check the response status and view
        $response->assertStatus(200);
        $response->assertViewHas('category', function ($viewcategorys) use ($category) {

        // Convert the collections to arrays of IDs
        $expectedcategoryIds = $category->pluck('id')->toArray();
        $viewcategoryIds = $viewcategorys->pluck('id')->toArray();
 
         // Assert that all expected user IDs are present in the view data
         $allExpectedCategoryPresent = !array_diff($expectedcategoryIds, $viewcategoryIds);
     
            return $allExpectedCategoryPresent;
        });

        
    }
    #[Test]
        public function it_can_delete_category()
        {
            $category = Category::factory()->create();
            // Send the request
            $response = $this->delete(route('category.destroy', $category->id));
            // Assert the correct redirect for regular user
            $response->assertRedirect(route('category.index'))
            ->assertSessionHas('success','Deleted successfully.');
        }
        #[Test]
        public function it_displays_a_category()
        {
            
            // Arrange: Create a product
            $category = Category::factory()->create();
    
            // Act: Send a GET request to view the product
            $response = $this->get(route('category.edit', $category->id));
    
    
            // Assert: Check the response status and view
            $response->assertStatus(200);
            $response->assertViewHas('row', $category);
        }
        #[Test]

   public function it_can_create_category()
   {
          
           // Create the request data
           $data = [
            'title' => fake()->name(),
            'description' => fake()->word()
        ];

        // Send the request
        $response = $this->post(route('category.store'), $data);

        // Assert the correct redirect for regular user
        $response->assertRedirect(route('category.index'))
        ->assertSessionHas('success','Category created successfully.');
   }
   #[Test]
   public function it_can_update_category()
   {
    $category = Category::factory()->create();
    // Send the request
   $updatedData = [
    'title'=>'Fruits'
   ];
    $response = $this->put(route('category.update', $category->id,$updatedData));

    // Assert the correct redirect for regular user
    $response->assertRedirect(route('category.index'))
    ->assertSessionHas('success','Updated successfully..');

   }
}
