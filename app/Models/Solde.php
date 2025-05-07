<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solde extends Model
{
    protected $fillable = [
       
        'value',
        'product_id',
        'category_id',
        'starts_at',
        'ends_at'
    ];

  

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(category::class, 'category_id');
    }

   
}
