<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["products"] = Product::all();
        $viewData["categories"] = Category::all(); 

        return view('admin.product.index')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        Product::validate($request);

        $newProduct = new Product();
      
        $newProduct->setCategoryId($request->input('category_id'));
        $newProduct->setName($request->input('name'));
        $newProduct->setDescription($request->input('description'));
        $newProduct->setPrice($request->input('price'));
        $newProduct->setImage("game.png");
        $newProduct->save();

        if ($request->hasFile('image')) {
            $imageName = $newProduct->getId().".".$request->file('image')->extension();
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
    return view('admin.product.edit')->with("viewData", $viewData);
    }


    public function update(Request $request, $id)
    {
        Product::validate($request);

        $product = Product::findOrFail($id);
        $product->setCategoryId($request->input('category_id'));
        $product->setName($request->input('name'));
        $product->setDescription($request->input('description'));
        $product->setPrice($request->input('price'));

        if ($request->hasFile('image')) {
            $imageName = $product->getId().".".$request->file('image')->extension();
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
        if(
            $category_id == "" 
        ){
            $viewData["products"] = Product::all();
 
        }else{
            $viewData["products"] = Product::where('category_id', $category_id)->get();
        }

        $viewData["categories"] = Category::all(); 

        return view('admin.product.index')->with("viewData", $viewData);
    }
    
}

