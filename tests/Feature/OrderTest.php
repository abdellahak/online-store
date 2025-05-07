<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
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
}
