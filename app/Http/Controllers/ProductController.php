<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $viewData = [];
        $viewData["title"] = "Products - Online Store";
        $viewData["subtitle"] =  "List of products";

        $productsQuery = Product::query();

        if ($request->has('show_sales')) {
            $productsQuery = $productsQuery->get()->filter(function ($product) {
                return $product->hasSoldes();
            });
            // If using filter, convert to paginator manually
            $perPage = 12;
            $currentPage = $request->input('page', 1);
            $items = $productsQuery->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $paginatedProducts = new \Illuminate\Pagination\LengthAwarePaginator(
                $items,
                count($productsQuery),
                $perPage,
                $currentPage,
                ['path' => $request->url(), 'query' => $request->query()]
            );
            $viewData["products"] = $paginatedProducts;
        } else {
            $viewData["products"] = Product::paginate(12);
        }

        return view('product.index')->with("viewData", $viewData);
    }

    public function show($id)
    {
        $viewData = [];
        $product = Product::findOrFail($id);
        $viewData["title"] = $product->getName() . " - Online Store";
        $viewData["subtitle"] =  $product->getName() . " - Product information";
        $viewData["product"] = $product;
        return view('product.show')->with("viewData", $viewData);
    }
}
