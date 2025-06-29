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
        $user = Auth::user();
        $productsInCookie = json_decode(Cookie::get('cart'), true);
        if ($productsInCookie) {
            $productsInCart = Product::findMany(array_keys($productsInCookie));
            $total = Product::sumPricesByQuantities($productsInCart, $productsInCookie);
        }

        $viewData = [];
        $viewData["title"] = "Cart - Online Store";
        $viewData["subtitle"] =  __('messages.cart.shared.title');
        $viewData["total"] = $total;
        $viewData["user"] = $user;
        $viewData["products"] = $productsInCart;
        return view('cart.index')->with("viewData", $viewData);
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $products = json_decode(Cookie::get('cart', '{}'), true);
        $quantity = (int) $request->input('quantity', 1);

        $currentQuantityInCart = $products[$id] ?? 0;
        $requestedTotalQuantity = $currentQuantityInCart + $quantity;

        if ($product->getQuantityStore() < $requestedTotalQuantity) {
            return back()->with('error', 'Not enough stock available for ' . $product->getName() . '. Available: ' . $product->getQuantityStore() . ', In Cart: ' . $currentQuantityInCart . ', Requested: ' . $quantity);
        }

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

    public function choosePayment(Request $request)
{
    $productsInCookie = json_decode(Cookie::get('cart'), true);
    $total = 0;
    $productsInCart = [];
    if ($productsInCookie) {
        $productsInCart = Product::findMany(array_keys($productsInCookie));
        $total = Product::sumPricesByQuantities($productsInCart, $productsInCookie);
    }
    $viewData = [];
    $viewData["total"] = $total;
    return view('cart.choose_payment')->with("viewData", $viewData);
}

    public function purchaseOnline(Request $request)
    {
        $productsInCookie = json_decode(Cookie::get('cart'), true);
        if ($productsInCookie) {
            $user = Auth::user();
            $productsInCart = Product::findMany(array_keys($productsInCookie));
            $total = 0;
            foreach ($productsInCart as $product) {
                $quantity = $productsInCookie[$product->getId()];
                $total += $product->getDiscountedPrice() * $quantity;
            }

            if ($user->balance < $total) {
                return back()->with('error', 'Your balance is insufficient to complete this purchase. Please choose the Cash on Delivery option or add funds to your account.');
            }

            $userId = $user->id;
            $order = new Order();
            $order->setUserId($userId);
            $order->setTotal(0);
            $order->setPaymentType('online');
            $order->save();

            foreach ($productsInCart as $product) {
                $quantity = $productsInCookie[$product->getId()];
                $item = new Item();
                $item->setQuantity($quantity);
                $item->setPrice($product->getDiscountedPrice());
                $item->setProductId($product->getId());
                $item->setOrderId($order->getId());
                $item->save();

                // Update product quantity in store
                $product->setQuantityStore($product->getQuantityStore() - $quantity);
                $product->save();
            }

            $order->setTotal($total);
            $order->save();

            $newBalance = $user->balance - $total;
            $user->balance = $newBalance;
            $user->save();

            // Clear the cart cookie after purchase
            Cookie::queue(Cookie::forget('cart'));

            $viewData = [];
            $viewData["title"] = "Purchase - Online Store";
            $viewData["subtitle"] =  "Purchase Status";
            $viewData["order"] =  $order;
            return view('cart.purchase')->with("viewData", $viewData);
        } else {
            return redirect()->route('cart.index');
        }
    }



    public function purchaseCod(Request $request)
{
    $productsInCookie = json_decode(Cookie::get('cart'), true);
    if ($productsInCookie) {
        $user = Auth::user();
        $userId = $user->id;
        $order = new Order();
        $order->setUserId($userId);
        $order->setTotal(0);
        $order->setPaymentType('cod'); 
        $order->save();

        $total = 0;
        $productsInCart = Product::findMany(array_keys($productsInCookie));
        foreach ($productsInCart as $product) {
            $quantity = $productsInCookie[$product->getId()];
            $item = new Item();
            $item->setQuantity($quantity);
            $item->setPrice($product->getPrice());
            $item->setProductId($product->getId());
            $item->setOrderId($order->getId());
            $item->save();
            $total += $product->getPrice() * $quantity;

            // Update product quantity in store
            $product->setQuantityStore($product->getQuantityStore() - $quantity);
            $product->save();
        }
        $order->setTotal($total);
        $order->save();

        // PAS de débit du solde utilisateur ici

        // Clear the cart cookie after purchase
        Cookie::queue(Cookie::forget('cart'));

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
