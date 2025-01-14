<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOutDetail extends Model
{
    protected $fillable = [
        'stock_out_id',
        'product_model_id',
        'quantity',
        'note',
    ];

    public function stockOut()
    {
        return $this->belongsTo(StockOut::class);
    }

    public function product()
    {
        return $this->belongsTo(ProductModel::class,'product_model_id','id');
    }
}
