<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];


    public function brands()
    {
        return $this->hasMany(ProductBrand::class);
    }


}
