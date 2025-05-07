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

        
      
        return redirect()->route('admin.soldes.index')->with('success', 'Solde created successfully!');
    }

    public function edit($id)
    {
        // Logic to show the form for editing an existing solde record
        return view('admin.solde.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing solde record in the database
        // Validate and save the data
        return redirect()->route('admin.solde.index')->with('success', 'Solde updated successfully!');
    }

    public function destroy($id)
    {
        // Logic to delete an existing solde record from the database
        return redirect()->route('admin.solde.index')->with('success', 'Solde deleted successfully!');
    }
}
