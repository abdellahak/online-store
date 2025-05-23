<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    /**
     * PRODUCT ATTRIBUTES
     * $this->attributes['id'] - int - contains the product primary key (id)
     * $this->attributes['name'] - string - contains the product name
     * $this->attributes['description'] - string - contains the product description
     * $this->attributes['image'] - string - contains the product image
     * $this->attributes['price'] - int - contains the product price
     * $this->attributes['created_at'] - timestamp - contains the product creation date
     * $this->attributes['updated_at'] - timestamp - contains the product update date
     * $this->items - Item[] - contains the associated items
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'quantity_store',
        'category_id',
        'supplier_id',
        'image',
    ];

    public static function validate($request)
    {
        $request->validate([
            "name" => "required|max:255",
            "description" => "required",
            "price" => "required|numeric|gt:0",
            'image' => 'image',
            'quantity_store' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);
    }

    public static function sumPricesByQuantities($products, $productsInSession)
    {
        $total = 0;
        foreach ($products as $product) {
            $total = $total + ($product->getDiscountedPrice()*$productsInSession[$product->getId()]);
        }

        return $total;
    }

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getDescription()
    {
        return $this->attributes['description'];
    }

    public function setDescription($description)
    {
        $this->attributes['description'] = $description;
    }

    public function getImage()
    {
        return $this->attributes['image'];
    }

    public function setImage($image)
    {
        $this->attributes['image'] = $image;
    }

    public function getPrice()
    {
        return $this->attributes['price'];
    }


    public function setPrice($price)
    {
        $this->attributes['price'] = $price;
    }

    public function getQuantityStore()
    {
        return $this->attributes['quantity_store'];
    }

    public function setQuantityStore($quantity_store)
    {
        $this->attributes['quantity_store'] = $quantity_store;
    }

    public function setCategoryId($category_id)
    {
        return $this->attributes['category_id']=$category_id;
    }
    public function setSupplierId($supplier_id)
    {
        return $this->attributes['supplier_id']=$supplier_id;
    }
    public function getCategoryId()
    {
        return $this->attributes['category_id'];
    }


    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($createdAt)
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->attributes['updated_at'] = $updatedAt;
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }


    public function soldes()
    {
        return $this->hasOne(Solde::class);
    }
    public function hasSoldes()
    {
        $solde = $this->getDiscountedPrice();
        $hassolde =$solde < $this->getPrice();
        return $hassolde;

    }

    public function getDiscountedPrice()
    {

        $price=$this->getPrice();
        $solde = $this->soldes()->where('starts_at', '<=', now())->where('ends_at', '>=', now())->first();
        if ($solde) {
             return $price - ($price * $solde->value / 100);
        }
        $categoriediscount = $this->Category->soldes()->where('starts_at', '<=', now())->where('ends_at', '>=', now())->first();
        if ($categoriediscount) {
            return $price - ($price * $categoriediscount->value / 100);
        }
        return $price;


    }

}
