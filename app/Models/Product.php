<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['PID', 'model_id', 'feature', 'description', 'image'];


    public function model()
    {
        return $this->belongsTo(ProductModel::class);
    }


}
