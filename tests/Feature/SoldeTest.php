<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Solde;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SoldeTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_solde()
    {
        // Ensure a category exists before creating a Solde
      $cat= Category::factory()->create();
      $suppliesr= Supplier::factory()->create();
      $product= Product::factory()->create();
    
        // Create a new Solde
        $solde = Solde::create([
            'value' => 30,
            'product_id' => $product->id,
            'category_id' => $cat->id,
            'starts_at' => '2025-06-01',
            'ends_at' => '2025-06-30'
        ]);
    
        // Assert that the Solde was created in the database with the correct value
        $this->assertDatabaseHas('soldes', [
            'product_id' => $product->id,
            'category_id' => $cat->id,
            'value' => 30
        ]);
    }
    
    

    public function test_it_can_update_a_solde()
    {
        $cat= Category::factory()->create();
        $suppliesr= Supplier::factory()->create();
        $product= Product::factory()->create();
        // Create a Solde to update
        $solde = Solde::factory()->create([
            'value' => 50,
            'product_id' => $product->id,
            'category_id' => $cat->id,
            'starts_at' => '2025-06-01',
            'ends_at' => '2025-06-30'
        ]);
    
        // Update the Solde
        $solde->update([
            'value' => 50,
         
        ]);
    
        // Assert that the Solde was updated in the database with the new value
        $this->assertDatabaseHas('soldes', [
            'product_id' => $product->id,
            'category_id' => $cat->id,
            'value' => 50
        ]);
    }
    public function test_it_can_delete_a_solde()
    {
        $cat= Category::factory()->create();
        $suppliesr= Supplier::factory()->create();
        $product= Product::factory()->create();
        // Create a Solde to delete
        $solde = Solde::factory()->create([
            'value' => 50,
            'product_id' => $product->id,
            'category_id' => $cat->id,
            'starts_at' => '2025-06-01',
            'ends_at' => '2025-06-30'
        ]);
    
        // Delete the Solde
        $solde->delete();
    
        // Assert that the Solde was deleted from the database
        $this->assertDatabaseMissing('soldes', [
           'id' => $solde->id,
            
        ]);
    }

   
}
