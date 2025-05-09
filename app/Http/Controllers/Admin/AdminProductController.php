<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class AdminProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["products"] = Product::all();
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
        if(
            $supplier_id == "" 
        ){
            $viewData["products"] = Product::all();
 
        }else{
            $viewData["products"] = Product::where('supplier_id', $supplier_id)->get();
        }

        $viewData["categories"] = Category::all();
        $viewData["suppliers"] = Supplier::all();

        return view('admin.product.index')->with("viewData", $viewData);
    }



    public function exportCsv()
    {
        $products = Product::all();
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=products.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['id', 'name', 'description', 'price', 'quantity_store', 'category_id', 'supplier_id', 'image', 'created_at', 'updated_at'];

        $callback = function() use ($products, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($products as $product) {
                fputcsv($file, [
                    $product->id,
                    $product->name,
                    $product->description,
                    $product->price,
                    $product->quantity_store,
                    $product->category_id,
                    $product->supplier_id,
                    $product->image,
                    $product->created_at,
                    $product->updated_at,
                ]);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file, 'r');
        $header = fgetcsv($handle);

        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);
            Product::updateOrCreate(['id' => $data['id']], [
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'quantity_store' => $data['quantity_store'],
                'category_id' => $data['category_id'],
                'supplier_id' => $data['supplier_id'],
                'image' => $data['image'],
            ]);
        }
        fclose($handle);

        return redirect()->route('admin.product.index')->with('success', 'Importation réussie.');
    }
}
