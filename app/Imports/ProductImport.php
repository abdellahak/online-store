<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Product([
            'name'           => $row['name'],
            'description'    => $row['description'],
            'price'          => $row['price'],
            'quantity_store' => $row['quantity_store'],
            'category_id'    => $row['category'],
            'supplier_id'    => $row['supplier'],
            'image'          => $row['image'],
        ]);
    }
}
