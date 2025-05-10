<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory(100)->create()->each(function ($order) {

            $items = Item::factory(5)->create([
                'order_id' => $order->id,
            ]);

            $order->items()->saveMany($items);

            $order->total = $order->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });
            $order->save();
        });
        for ($i = 0; $i < 20; $i++) {
            $randomDay = rand(1, now()->daysInMonth);
            $randomDate = Carbon::now()->startOfMonth()->addDays($randomDay - 1)->setTime(rand(0,23), rand(0,59), rand(0,59));
            $order = Order::factory()->create([
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);
            $items = Item::factory(5)->create([
                'order_id' => $order->id,
            ]);
            $order->items()->saveMany($items);
            $order->total = $order->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });
            $order->save();
        }
    }
}
