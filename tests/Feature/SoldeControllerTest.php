<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Solde;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SoldeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_displays_the_solde_list()
    {

        $category = Category::factory()->create();
        $supplier = Supplier::factory()->create(); 
       $product = Product::factory()->create();  // Create a product
        // Create a supplier
      
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

       
        Solde::factory()->count(3)->create(
            []
        );

        $response = $this->get(route('admin.soldes.index'));  // Request the solde list

        $response->assertStatus(200);  // Check the response status
        $response->assertSee('Soldes');  // Ensure the page displays the correct content
    }

    public function test_it_can_create_a_solde()
    { 
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        $category = Category::factory()->create();  // Create a category
        $supplier = Supplier::factory()->create();  // Create a supplier
        $product = Product::factory()->create();  // Create a product

        $response = $this->post(route('admin.soldes.store'), [
           
            'product_id' => $product->id,
            'category_id' => $category->id,
            'value' => 30,  // Value for the solde
            'starts_at' => now()->subDays(3),  // Set the start date
            'ends_at' => now()->addDays(7),  // Set the end date
        
        ]);

        $this->assertDatabaseHas('soldes', ['value' => 30]);  // Check if the solde is in the database
        $response->assertRedirect(route('admin.soldes.index'));  // Ensure the response redirects to the solde list
    }

    public function test_it_can_update_a_solde()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        $category = Category::factory()->create();  // Create a category
        $supplier = Supplier::factory()->create();  // Create a supplier
        $product = Product::factory()->create();  // Create a product

        $solde = Solde::factory()->create(
            [
                'value' => 30,  // Initial value for the solde
                'product_id' => $product->id,  // Associate the solde with the product
                'category_id' => $category->id,  // Associate the solde with the category
                'starts_at' => now()->subDays(3),  // Set the start date
                'ends_at' => now()->addDays(7),  // Set the end date
            ]
        );  // Create a solde

        $response = $this->put(route('admin.soldes.update', $solde->id), [
            'value' => 50,  // New value for the solde
            'starts_at' => now()->subDays(3),  // Update the start date
            'ends_at' => now()->addDays(7),  // Update the end date
            
        
        ]);

        $this->assertDatabaseHas('soldes', ['value' => 50]);  // Ensure the updated value is in the database
        $response->assertRedirect(route('admin.soldes.index'));  // Check if the response redirects correctly
    }

    public function test_it_can_delete_a_solde()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        $category = Category::factory()->create();  // Create a category
        $supplier = Supplier::factory()->create();  // Create a supplier
        $product = Product::factory()->create();  // Create a product

        $solde = Solde::factory()->create(
            [
                'value' => 30,  // Initial value for the solde
                'product_id' => $product->id,  // Associate the solde with the product
                'category_id' => $category->id,  // Associate the solde with the category
                'starts_at' => now()->subDays(3),  // Set the start date
                'ends_at' => now()->addDays(7),  // Set the end date
            ]
        );  // Create a solde

        $response = $this->delete(route('admin.soldes.destroy', $solde->id));

        $this->assertDatabaseMissing('soldes', ['id' => $solde->id]);  // Ensure the solde is deleted from the database
        $response->assertRedirect(route('admin.soldes.index'));  // Check if the response redirects correctly
    }
}
