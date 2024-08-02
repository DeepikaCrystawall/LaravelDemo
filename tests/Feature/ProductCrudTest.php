<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Mockery;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Http\UploadedFile;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase,WithFaker;
    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a test user and authenticate them
        $this->user = User::factory()->create(['role_id'=>1]);
        $this->actingAs($this->user);
    }  

    #[Test]
    public function it_list_product()
    {
        
        // Arrange: Create a product
        $product = Product::factory()->create(['category_id'=>1]);
      
      
        // Act: Send a GET request to view the product
        $response = $this->get(route('products.index'));

        // Debugging: Log the response content
        Log::info($response->getContent());
 
        // Assert: Check the response status and view
        $response->assertStatus(200);
        $response->assertViewHas('products', function ($viewproducts) use ($product) {

        // Convert the collections to arrays of IDs
        $expectedproductIds = $product->pluck('id')->toArray();
        $viewproductIds = $viewproducts->pluck('id')->toArray();
 
         // Assert that all expected user IDs are present in the view data
         $allExpectedProductsPresent = !array_diff($expectedproductIds, $viewproductIds);
     
            return $allExpectedProductsPresent;
        });

        
    }
    #[Test]
        public function it_can_delete_product()
        {
            $product = Product::factory()->create(['category_id'=>1]);
            // Send the request
            $response = $this->delete(route('products.destroy', $product->id));
            // Assert the correct redirect for regular user
            $response->assertRedirect(route('products.index'))
            ->assertSessionHas('success','Deleted successfully.');
        }
    #[Test]
    public function it_displays_a_product()
    {
        
        // Arrange: Create a product
        $product = Product::factory()->create();

        // Act: Send a GET request to view the product
        $response = $this->get(route('products.edit', $product->id));


        // Assert: Check the response status and view
        $response->assertStatus(200);
        $response->assertViewHas('row', $product);
    }
    #[Test]
    public function it_update_a_product()
    {
        
      // Arrange: Create a ticket
      $category = Category::factory()->create();
      $product = Product::factory()->create();
      $data = [
        'title'       => 'Test Product',
        'short_desc'  =>'Test Short Description',
        'description' => 'Test Description',
        'category_id' => $category->id,
        'price'       =>'10.00',
        'image_alt'   =>'Test Image Alt',
        'status'      =>'1'
    ];

      // Act: Send a PUT request to update the product
      $response = $this->put(route('products.update', $product->id), $data);


      // Assert: Check the product was updated and redirected
      $response->assertStatus(302); // Assuming redirection after update
      $response->assertRedirect(route('products.index'));

      $this->assertDatabaseHas('products', $data);
      $this->assertDatabaseMissing('products', ['title' => $product->title]);
    }

    #[Test]
    public function it_creates_a_product()
    {
        // Fake the storage
        Storage::fake('public');

        $file = UploadedFile::fake()->image('product.jpg');
        // Arrange: Create a Category
        $category = Category::factory()->create();

    
        // Create the request data
        $data = [
            'title'       => 'Test Product',
            'short_desc'  =>'Test Short Description',
            'description' => 'Test Description',
            'category_id' => $category->id,
            'price'       =>'10.00',
            'image'       => $file,
            'image_alt'   =>'Test Image Alt',
            'status'      =>'1'
        ];
     
       
        // Send the request
        $response = $this->post(route('products.store'), $data);

         // Assert: Check the response status and redirect
         $response->assertStatus(302); // Expecting a redirect status

         $expectedFileName = $file->hashName('uploads/products');
         Storage::disk('public')->assertExists($expectedFileName);

          // Assert: Check if the product was created
        $this->assertDatabaseHas('products', [
            'title'       => 'Test Product',
            'short_desc'  =>'Test Short Description',
            'description' => 'Test Description',
            'category_id' => $category->id,
            'price'       =>'10.00',
            'image'       =>$expectedFileName,
            'image_alt'   =>'Test Image Alt',
            'status'      =>'1'
        ]);
         $response->assertRedirect(route('products.index'));
         $response->assertSessionHas('success', 'Product created successfully.');
    }
  

    
    
}
