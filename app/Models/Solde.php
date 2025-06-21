<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Solde extends Model
{
    use HasFactory;
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
        return $this->belongsTo(Category::class, 'category_id');
    }
}
