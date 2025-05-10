<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_displays_order_list()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        Order::factory()->count(3)->create(['user_id' => $user->id]);
        $response = $this->get(route('admin.order.index'));
        $response->assertStatus(200);
        $response->assertSee('Orders');
    }

    

    public function test_it_can_update_an_order()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        $order = Order::factory()->create(['user_id' => $user->id]);
        $response = $this->put(route('admin.order.update', $order->id), [
        'status' => 'Emballé',
        ]);
        $this->assertDatabaseHas('orders', ['status' => 'Emballé']);
        $response->assertRedirect(route('admin.order.index'));
    }

    public function test_it_can_delete_an_order()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        $order = Order::factory()->create(['user_id' => $user->id]);
        $response = $this->delete(route('admin.order.destroy', $order->id));
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
        $response->assertRedirect(route('admin.order.index'));
    }
}
