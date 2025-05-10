<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Item;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;
    public function test_it_can_create_a_order()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        // Attach the order to the user
        $order = Order::factory()->create([
            'user_id' => $user->id,
            'status' => 'Emballé',
        ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'Emballé',
        ]);
    }
    public function test_it_can_update_a_order()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        $order = Order::factory()->create(['user_id' => $user->id]);
        $order->update(['status' => 'Emballé']);
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'Emballé',
        ]);
    }
    public function test_it_can_delete_a_order()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        $order = Order::factory()->create(['user_id' => $user->id]);
        $order->delete();
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }


    public function test_it_can_calculate_total()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        Category::factory(1)->create();
        Supplier::factory(1)->create();
        Product::factory(10)->create();

        $order = Order::factory()->create([
            'user_id' => $user->id,
        ]);

        $items = Item::factory(5)->create([
            'order_id' => $order->id,
        ]);

        $order->items()->saveMany($items);

        $order->total = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $order->save();

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'total' => $order->total,
        ]);
    }
}
