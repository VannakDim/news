<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBrand extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'brand_name',
        'brand_logo',
        'brand_description',
        'brand_status',
        'brand_country',
    ];


    public function models()
    {
        return $this->hasMany(ProductModel::class);
    }
    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }
}
