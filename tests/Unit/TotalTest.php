<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Order;
use App\Models\Product;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Solde;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * TotalTest - Comprehensive unit tests for total calculations in the online store
 * 
 * This test class covers:
 * - Order total calculation from items (price * quantity)
 * - Cart total calculation using Product::sumPricesByQuantities()
 * - Individual item total calculations
 * - Product discount calculations (regular and discounted prices)
 * - Edge cases (empty carts, zero quantities, large quantities)
 * - Order total getter/setter and persistence
 * - Complex scenarios with multiple items and discounts
 * 
 * Note: The system stores prices as integers (e.g., $15.00 = 15 in database)
 */
class TotalTest extends TestCase
{
  use RefreshDatabase;

  /**
   * Test basic order total calculation from items
   */
  public function test_order_total_calculation()
  {
    // Create test data
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $supplier = Supplier::factory()->create();

    $order = Order::factory()->create([
      'user_id' => $user->id,
      'total' => 0
    ]);
    $product1 = Product::factory()->create([
      'price' => 15, // Prices stored as integers (15 = $15.00)
      'category_id' => $category->id,
      'supplier_id' => $supplier->id
    ]);

    $product2 = Product::factory()->create([
      'price' => 26, // 26 = $26.00
      'category_id' => $category->id,
      'supplier_id' => $supplier->id
    ]);

    // Create items
    Item::create([
      'order_id' => $order->id,
      'product_id' => $product1->id,
      'price' => 15,
      'quantity' => 2
    ]);

    Item::create([
      'order_id' => $order->id,
      'product_id' => $product2->id,
      'price' => 26,
      'quantity' => 3
    ]);

    // Calculate total
    $calculatedTotal = $order->items->sum(function ($item) {
      return $item->getPrice() * $item->getQuantity();
    });

    // Expected: (15 * 2) + (26 * 3) = 30 + 78 = 108
    $this->assertEquals(108, $calculatedTotal);
    // Update order
    $order->setTotal($calculatedTotal);
    $order->save();

    $this->assertEquals(108, $order->getTotal());
  }

  /**
   * Test Product::sumPricesByQuantities method
   */
  public function test_product_sum_prices_by_quantities()
  {
    $category = Category::factory()->create();
    $supplier = Supplier::factory()->create();

    $product1 = Product::factory()->create([
      'price' => 10.00,
      'category_id' => $category->id,
      'supplier_id' => $supplier->id
    ]);

    $product2 = Product::factory()->create([
      'price' => 20.00,
      'category_id' => $category->id,
      'supplier_id' => $supplier->id
    ]);

    $products = collect([$product1, $product2]);
    $quantities = [
      $product1->getId() => 2,
      $product2->getId() => 3
    ];

    $total = Product::sumPricesByQuantities($products, $quantities);

    // Expected: (10 * 2) + (20 * 3) = 20 + 60 = 80
    $this->assertEquals(80.00, $total);
  }

  /**
   * Test individual item total calculation
   */
  public function test_item_total_calculation()
  {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $supplier = Supplier::factory()->create();
    $product = Product::factory()->create([
      'price' => 13, // 13 = $13.00 as integer
      'category_id' => $category->id,
      'supplier_id' => $supplier->id
    ]);

    $order = Order::factory()->create(['user_id' => $user->id]);

    $item = Item::create([
      'order_id' => $order->id,
      'product_id' => $product->id,
      'price' => 13,
      'quantity' => 4
    ]);

    $itemTotal = $item->getPrice() * $item->getQuantity();

    // Expected: 13 * 4 = 52
    $this->assertEquals(52, $itemTotal);
  }

  /**
   * Test empty cart total
   */
  public function test_empty_cart_total()
  {
    $products = collect([]);
    $quantities = [];

    $total = Product::sumPricesByQuantities($products, $quantities);

    $this->assertEquals(0, $total);
  }

  /**
   * Test order total getter and setter
   */
  public function test_order_total_getter_setter()
  {
    $user = User::factory()->create();
    $order = Order::factory()->create([
      'user_id' => $user->id,
      'total' => 0
    ]);        // Test setter and getter
    $order->setTotal(151); // Using integer value
    $this->assertEquals(151, $order->getTotal());

    // Test persistence
    $order->save();
    $order->refresh();
    $this->assertEquals(151, $order->getTotal());
  }

  /**
   * Test cart total with discounted products
   */
  public function test_cart_total_with_product_discount()
  {
    $category = Category::factory()->create();
    $supplier = Supplier::factory()->create();

    $product = Product::factory()->create([
      'price' => 100, // $100.00 as integer
      'category_id' => $category->id,
      'supplier_id' => $supplier->id
    ]);

    // Create a 20% discount
    Solde::create([
      'product_id' => $product->id,
      'category_id' => null,
      'value' => 20,
      'starts_at' => now()->subDay(),
      'ends_at' => now()->addDay()
    ]);

    $products = collect([$product]);
    $quantities = [$product->getId() => 1];

    $total = Product::sumPricesByQuantities($products, $quantities);

    // Expected: 100 - (100 * 20/100) = 80
    $this->assertEquals(80.00, $total);
  }

  /**
   * Test complex order total with multiple items
   */
  public function test_complex_order_with_multiple_items()
  {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $supplier = Supplier::factory()->create();

    $order = Order::factory()->create([
      'user_id' => $user->id,
      'total' => 0
    ]);

    // Product 1: Regular price
    $product1 = Product::factory()->create([
      'price' => 25,
      'category_id' => $category->id,
      'supplier_id' => $supplier->id
    ]);

    // Product 2: Different price
    $product2 = Product::factory()->create([
      'price' => 50,
      'category_id' => $category->id,
      'supplier_id' => $supplier->id
    ]);

    // Product 3: Another price
    $product3 = Product::factory()->create([
      'price' => 75,
      'category_id' => $category->id,
      'supplier_id' => $supplier->id
    ]);

    // Create multiple items
    Item::create([
      'order_id' => $order->id,
      'product_id' => $product1->id,
      'price' => 25,
      'quantity' => 2
    ]);

    Item::create([
      'order_id' => $order->id,
      'product_id' => $product2->id,
      'price' => 50,
      'quantity' => 1
    ]);

    Item::create([
      'order_id' => $order->id,
      'product_id' => $product3->id,
      'price' => 75,
      'quantity' => 3
    ]);

    // Calculate total
    $calculatedTotal = $order->items->sum(function ($item) {
      return $item->getPrice() * $item->getQuantity();
    });

    // Expected: (25*2) + (50*1) + (75*3) = 50 + 50 + 225 = 325
    $this->assertEquals(325, $calculatedTotal);

    $order->setTotal($calculatedTotal);
    $order->save();

    $this->assertEquals(325, $order->getTotal());
  }

  /**
   * Test cart total with zero quantities
   */
  public function test_cart_total_with_zero_quantities()
  {
    $category = Category::factory()->create();
    $supplier = Supplier::factory()->create();

    $product = Product::factory()->create([
      'price' => 50,
      'category_id' => $category->id,
      'supplier_id' => $supplier->id
    ]);

    $products = collect([$product]);
    $quantities = [$product->getId() => 0];

    $total = Product::sumPricesByQuantities($products, $quantities);

    $this->assertEquals(0, $total);
  }

  /**
   * Test large quantity calculations
   */
  public function test_large_quantity_calculation()
  {
    $category = Category::factory()->create();
    $supplier = Supplier::factory()->create();

    $product = Product::factory()->create([
      'price' => 5, // $5.00
      'category_id' => $category->id,
      'supplier_id' => $supplier->id
    ]);

    $products = collect([$product]);
    $quantities = [$product->getId() => 100];

    $total = Product::sumPricesByQuantities($products, $quantities);

    // Expected: 5 * 100 = 500
    $this->assertEquals(500, $total);
  }

  /**
   * Test product discount methods
   */
  public function test_product_discount_methods()
  {
    $category = Category::factory()->create();
    $supplier = Supplier::factory()->create();

    $product = Product::factory()->create([
      'price' => 80,
      'category_id' => $category->id,
      'supplier_id' => $supplier->id
    ]);

    // Test without discount
    $this->assertEquals(80.00, $product->getDiscountedPrice());
    $this->assertFalse($product->hasSoldes());

    // Add a 25% discount
    Solde::create([
      'product_id' => $product->id,
      'category_id' => null,
      'value' => 25,
      'starts_at' => now()->subDay(),
      'ends_at' => now()->addDay()
    ]);

    // Test with discount: 80 - (80 * 25/100) = 60
    $this->assertEquals(60.00, $product->getDiscountedPrice());
    $this->assertTrue($product->hasSoldes());
  }

  /**
   * Test order with no items
   */
  public function test_order_with_no_items()
  {
    $user = User::factory()->create();
    $order = Order::factory()->create([
      'user_id' => $user->id,
      'total' => 0
    ]);

    $calculatedTotal = $order->items->sum(function ($item) {
      return $item->getPrice() * $item->getQuantity();
    });

    $this->assertEquals(0, $calculatedTotal);
    $this->assertCount(0, $order->items);
  }
}
