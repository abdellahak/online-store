<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function getOrders(){
        $user = Auth::user();
        $orders = $user->orders()->get();
        return response()->json($orders,200);
    }
    public function show(string $id)
    {
        $order = Auth::user()->orders()->find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return response()->json($order, 200);
    }

}
