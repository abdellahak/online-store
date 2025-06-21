<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Solde;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
  use RefreshDatabase;

  protected function setUp(): void
  {
    parent::setUp();
    // Create required dependencies
    Category::factory()->create();
    Supplier::factory()->create();
  }
  public function test_it_can_create_a_product()
  {
    $category = Category::factory()->create();
    $supplier = Supplier::factory()->create();

    $product = Product::create([
      'name' => 'Test Laptop',
      'description' => 'A high-performance laptop',
      'price' => 1000,
      'quantity_store' => 10,
      'category_id' => $category->id,
      'supplier_id' => $supplier->id,
      'image' => 'laptop.jpg',
    ]);

    $this->assertDatabaseHas('products', [
      'name' => 'Test Laptop',
      'price' => 1000,
    ]);
  }

  public function test_it_can_update_a_product()
  {
    $product = Product::factory()->create();
    $product->update(['name' => 'Updated Product Name']);

    $this->assertDatabaseHas('products', ['name' => 'Updated Product Name']);
  }

  public function test_it_can_delete_a_product()
  {
    $product = Product::factory()->create();
    $product->delete();

    $this->assertDatabaseMissing('products', ['id' => $product->id]);
  }

  public function test_it_can_get_product_name()
  {
    $product = Product::factory()->create(['name' => 'Test Product']);

    $this->assertEquals('Test Product', $product->getName());
  }

  public function test_it_can_set_product_name()
  {
    $product = Product::factory()->create();
    $product->setName('New Product Name');

    $this->assertEquals('New Product Name', $product->getName());
  }
  public function test_it_can_get_product_price()
  {
    $product = Product::factory()->create(['price' => 150]);

    $this->assertEquals(150, $product->getPrice());
  }

  public function test_it_can_set_product_price()
  {
    $product = Product::factory()->create();
    $product->setPrice(200);

    $this->assertEquals(200, $product->getPrice());
  }

  public function test_it_can_get_product_description()
  {
    $product = Product::factory()->create(['description' => 'Test description']);

    $this->assertEquals('Test description', $product->getDescription());
  }

  public function test_it_can_set_product_description()
  {
    $product = Product::factory()->create();
    $product->setDescription('New description');

    $this->assertEquals('New description', $product->getDescription());
  }

  public function test_it_can_get_quantity_store()
  {
    $product = Product::factory()->create(['quantity_store' => 25]);

    $this->assertEquals(25, $product->getQuantityStore());
  }

  public function test_it_can_set_quantity_store()
  {
    $product = Product::factory()->create();
    $product->setQuantityStore(50);

    $this->assertEquals(50, $product->getQuantityStore());
  }

  public function test_it_belongs_to_category()
  {
    $category = Category::factory()->create();
    $product = Product::factory()->create(['category_id' => $category->id]);

    $this->assertInstanceOf(Category::class, $product->Category);
    $this->assertEquals($category->id, $product->Category->id);
  }

  public function test_it_belongs_to_supplier()
  {
    $supplier = Supplier::factory()->create();
    $product = Product::factory()->create(['supplier_id' => $supplier->id]);

    $this->assertInstanceOf(Supplier::class, $product->supplier);
    $this->assertEquals($supplier->id, $product->supplier->id);
  }

  public function test_it_can_have_discounted_price_with_product_solde()
  {
    $product = Product::factory()->create(['price' => 100]);

    // Create a solde for the product with 20% discount
    Solde::create([
      'value' => 20,
      'product_id' => $product->id,
      'category_id' => null,
      'starts_at' => now()->subDay(),
      'ends_at' => now()->addDay(),
    ]);

    $discountedPrice = $product->getDiscountedPrice();
    $this->assertEquals(80, $discountedPrice); // 100 - (100 * 20/100) = 80
  }

  public function test_it_can_have_discounted_price_with_category_solde()
  {
    $category = Category::factory()->create();
    $product = Product::factory()->create(['price' => 100, 'category_id' => $category->id]);

    // Create a solde for the category with 15% discount
    Solde::create([
      'value' => 15,
      'product_id' => null,
      'category_id' => $category->id,
      'starts_at' => now()->subDay(),
      'ends_at' => now()->addDay(),
    ]);

    $discountedPrice = $product->getDiscountedPrice();
    $this->assertEquals(85, $discountedPrice); // 100 - (100 * 15/100) = 85
  }

  public function test_it_returns_original_price_when_no_solde()
  {
    $product = Product::factory()->create(['price' => 100]);

    $discountedPrice = $product->getDiscountedPrice();
    $this->assertEquals(100, $discountedPrice);
  }

  public function test_it_can_check_if_has_soldes()
  {
    $product = Product::factory()->create(['price' => 100]);

    // Initially no solde
    $this->assertFalse($product->hasSoldes());

    // Create a solde
    Solde::create([
      'value' => 10,
      'product_id' => $product->id,
      'category_id' => null,
      'starts_at' => now()->subDay(),
      'ends_at' => now()->addDay(),
    ]);

    // Refresh the model to get updated relationships
    $product->refresh();
    $this->assertTrue($product->hasSoldes());
  }

  public function test_sum_prices_by_quantities()
  {
    $product1 = Product::factory()->create(['price' => 50]);
    $product2 = Product::factory()->create(['price' => 30]);

    $products = collect([$product1, $product2]);
    $productsInSession = [
      $product1->getId() => 2,
      $product2->getId() => 3,
    ];

    $total = Product::sumPricesByQuantities($products, $productsInSession);
    $expected = (50 * 2) + (30 * 3); // 100 + 90 = 190

    $this->assertEquals($expected, $total);
  }
}
