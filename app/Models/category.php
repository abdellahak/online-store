<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];
    public static function validate($request)
    {
        $request->validate([
            "name" => "required|max:255",
            "description" => "required",
           
          
        ]);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }


    public function soldes()
    {
        return $this->hasOne(Solde::class);
    }
}
