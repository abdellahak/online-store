<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductExport;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;

class AdminProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["products"] = Product::paginate(10);
        $viewData["categories"] = Category::all();
        $viewData["suppliers"] = Supplier::all();

        return view('admin.product.index')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        Product::validate($request);

        $newProduct = new Product();

        $newProduct->setCategoryId($request->input('category_id'));
        $newProduct->setSupplierId($request->input('supplier_id'));
        $newProduct->setName($request->input('name'));
        $newProduct->setDescription($request->input('description'));
        $newProduct->setPrice($request->input('price'));
        $newProduct->setQuantityStore($request->input('quantity_store'));
        $newProduct->setImage("default.jpg");
        $newProduct->save();

        if ($request->hasFile('image')) {
            $imageName = $newProduct->getName() . "-" . $newProduct->getId() . "." . $request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $newProduct->setImage($imageName);
            $newProduct->save();
        }

        return back();
    }

    public function delete($id)
    {
        Product::destroy($id);
        return back();
    }

    public function edit($id)
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Edit Product - Online Store";
        $viewData["product"] = Product::findOrFail($id);
        $viewData["categories"] = Category::all();
        $viewData["suppliers"] = Supplier::all();
        return view('admin.product.edit')->with("viewData", $viewData);
    }


    public function update(Request $request, $id)
    {
        Product::validate($request);

        $product = Product::findOrFail($id);
        $product->setCategoryId($request->input('category_id'));
        $product->setSupplierId($request->input('supplier_id'));
        $product->setName($request->input('name'));
        $product->setDescription($request->input('description'));
        $product->setPrice($request->input('price'));
        $product->setQuantityStore($request->input('quantity_store'));

        if ($request->hasFile('image')) {
            $imageName = $product->getId() . "." . $request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $product->setImage($imageName);
        }

        $product->save();
        return redirect()->route('admin.product.index');
    }
    public function filterparcategory(Request $request)
    {
        $category_id = $request->input('category_id');
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        if (
            $category_id == ""
        ) {
            $viewData["products"] = Product::all();
        } else {
            $viewData["products"] = Product::where('category_id', $category_id)->get();
        }

        $viewData["categories"] = Category::all();
        $viewData["suppliers"] = Supplier::all();


        return view('admin.product.index')->with("viewData", $viewData);
    }
    public function filterparsupplier(Request $request)
    {
        $supplier_id = $request->input('supplier_id');
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        if (
            $supplier_id == ""
        ) {
            $viewData["products"] = Product::all();
        } else {
            $viewData["products"] = Product::where('supplier_id', $supplier_id)->get();
        }

        $viewData["categories"] = Category::all();
        $viewData["suppliers"] = Supplier::all();

        return view('admin.product.index')->with("viewData", $viewData);
    }



    public function export(Request $request)
    {
        $page = $request->query("page");
        $products = null;
        if (!$page) {
            $products = Product::all()->map(fn($product) => [
                "id" => $product->id,
                "name" => $product->name,
                "description" => $product->description,
                "price" => $product->price,
                "quantity_store" => $product->quantity_store,
                "category" => $product->Category->name,
                "supplier" => $product->supplier->raison_sociale,
                "image" => $product->image,
            ]);
        } else {
            $products = Product::paginate(10)->getCollection()->map(fn($product) => [
                "name" => $product->name,
                "description" => $product->description,
                "price" => $product->price,
                "quantity_store" => $product->quantity_store,
                "category" => $product->Category->name,
                "supplier" => $product->supplier->raison_sociale,
                "image" => $product->image,
            ]);
        }
        $products = $products->map(function ($product) {
            return [
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'quantity_store' => $product['quantity_store'],
                'category' => $product['category'],
                'supplier' => $product['supplier'],
                'image' => $product['image'],
            ];
        });

        $excel = collect($products);
        if ($page) {
            return Excel::download(new ProductExport($excel), "products-list-page-$page.xlsx");
        }
        return Excel::download(new ProductExport($excel), "products-list.xlsx");
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:xlsx,csv,txt'
        ]);

        Excel::import(new ProductImport, $request->file('csv_file'));

        return redirect()->route('admin.product.index')->with('success', 'Importation réussie.');
    }

    public function downloadExample()
    {
        $exampleData = collect([
            [
                'name' => 'Example Product',
                'description' => 'Description here',
                'price' => 100,
                'quantity_store' => 10,
                'category_id' => 1,
                'supplier_id' => 1,
                'image' => 'example.jpg',
            ]
        ]);

        return Excel::download(
            new ProductExport($exampleData),
            'products_example.xlsx'
        );
    }
}
