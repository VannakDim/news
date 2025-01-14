<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    use SoftDeletes;
    protected $fillable = ['category_id', 'brand_id', 'name', 'frequency', 'type', 'capacity', 'power', 'description', 'image'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function brand()
    {
        return $this->belongsTo(ProductBrand::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

}
