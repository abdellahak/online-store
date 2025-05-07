<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory(10)->create()->each(function ($order) {
            
            $items = Item::factory(5)->create([
                'order_id' => $order->id,
            ]);

            $order->items()->saveMany($items);

            $order->total = $order->items->sum(function ($item){
                return $item->price * $item->quantity;
            });
            $order->save();
        });
    }
}
