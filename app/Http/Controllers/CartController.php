<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $total = 0;
        $productsInCart = [];

        $productsInCookie = json_decode(Cookie::get('cart'), true);
        if ($productsInCookie) {
            $productsInCart = Product::findMany(array_keys($productsInCookie));
            $total = Product::sumPricesByQuantities($productsInCart, $productsInCookie);
        }

        $viewData = [];
        $viewData["title"] = "Cart - Online Store";
        $viewData["subtitle"] =  "Shopping Cart";
        $viewData["total"] = $total;
        $viewData["products"] = $productsInCart;
        return view('cart.index')->with("viewData", $viewData);
    }

    public function add(Request $request, $id)
    {
        $products = json_decode(Cookie::get('cart', '{}'), true);
        $quantity = (int) $request->input('quantity', 1);
        if (isset($products[$id])) {
            $products[$id] += $quantity;
        } else {
            $products[$id] = $quantity;
        }
        return redirect()->route('cart.index')->cookie('cart', json_encode($products), 60 * 24 * 7);
    }
    

    public function delete(Request $request)
    {
        return back()->withCookie(Cookie::forget('cart'));
    }

    public function purchase(Request $request)
    {
        $productsInSession = $request->session()->get("products");
        if ($productsInSession) {
            $userId = Auth::user()->getId();
            $order = new Order();
            $order->setUserId($userId);
            $order->setTotal(0);
            $order->save();

            $total = 0;
            $productsInCart = Product::findMany(array_keys($productsInSession));
            foreach ($productsInCart as $product) {
                $quantity = $productsInSession[$product->getId()];
                $item = new Item();
                $item->setQuantity($quantity);
                $item->setPrice($product->getPrice());
                $item->setProductId($product->getId());
                $item->setOrderId($order->getId());
                $item->save();
                $total = $total + ($product->getPrice()*$quantity);
            }
            $order->setTotal($total);
            $order->save();

            $newBalance = Auth::user()->getBalance() - $total;
            Auth::user()->setBalance($newBalance);
            Auth::user()->save();

            $request->session()->forget('products');

            $viewData = [];
            $viewData["title"] = "Purchase - Online Store";
            $viewData["subtitle"] =  "Purchase Status";
            $viewData["order"] =  $order;
            return view('cart.purchase')->with("viewData", $viewData);
        } else {
            return redirect()->route('cart.index');
        }
    }
}
