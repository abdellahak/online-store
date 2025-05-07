<?php

namespace App\Http\Controllers\Admin;

use App\Models\Solde;
use App\Models\Product;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSoldeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["soldes"]=Solde::with(["product","category"])->get();

        $viewData["title"]=" list of Soldes";
        $viewData["categories"] = category::all();
        $viewData["products"] = Product::all();
        $viewData["soldes"] =$viewData["soldes"]->map(function ($solde) {
            $solde->starts_at = \Carbon\Carbon::parse($solde->starts_at)->format('Y-m-d');
            $solde->ends_at = \Carbon\Carbon::parse($solde->ends_at)->format('Y-m-d');
            
            return $solde;
        });
      return view('admin.soldes.index', compact('viewData'));
    }

   



    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required_without:category_id|nullable|exists:products,id',
            'category_id' => 'required_without:product_id|nullable|exists:categories,id',
            'value' => 'required|numeric|min:0|max:100',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after:starts_at',
        ]);
        Solde::create($request->all());
        $product_id=$request->input('product_id');
        $category_id=$request->input('category_id');
        if ($product_id) {
            $product = Product::find($product_id);
            $discountedPrice = $product->getPrice() - ($product->getPrice() * $request->input('value') / 100);
            $product->setPrice($discountedPrice);
            $product->save();
        }
        if ($category_id) {
            $products = Product::where('category_id', $category_id)->get();
            foreach ($products as $product) {
                $discountedPrice = $product->getPrice() - ($product->getPrice() * $request->input('value') / 100);
                $product->setPrice($discountedPrice);
                $product->save();
            }
        }

      

        return redirect()->route('admin.soldes.index')->with('success', 'Solde created successfully!');

    }

   
    public function edit($id)
    {
        $solde = Solde::findOrFail($id);
        $products = Product::all();
        $categories = Category::all();
    
        $solde->starts_at = \Carbon\Carbon::parse($solde->starts_at)->format('Y-m-d');
        $solde->ends_at = \Carbon\Carbon::parse($solde->ends_at)->format('Y-m-d');
    


        return view('admin.soldes.edit', [
            'solde' => $solde,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'category_id' => 'nullable|exists:categories,id',
            'value' => 'required|numeric|min:0|max:100',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after:starts_at',
        ]);
    
        $solde = Solde::findOrFail($id);
        $solde->update($request->all());
    
        return redirect()->route('admin.soldes.index')->with('success', 'Solde updated successfully!');
    }
    

    public function destroy(Request $request,$id)
    {
        
        
        $solde = Solde::findOrFail($id);

   
        if ($solde->product_id) {
            $product = $solde->product; 
            $discountValue = $solde->value;
            $currentPrice = $product->getPrice();
            $originalPrice = $currentPrice / (1 - $discountValue / 100);
            
            $product->setPrice($originalPrice);
            $product->save();
        }

        
        if ($solde->category_id) {
            $category = $solde->category; 

            foreach ($category->products as $product) { 
                $discountValue = $solde->value;
                $currentPrice = $product->getPrice();
                $originalPrice = $currentPrice / (1 - $discountValue / 100);

                $product->setPrice($originalPrice);
                $product->save();
            }
        }
        $solde->delete(); 
        return redirect()->route('admin.soldes.index')->with('success', 'Solde deleted successfully!');
    }






 
}
