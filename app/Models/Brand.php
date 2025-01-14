<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Brand extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'brand_name',
        'brand_image',
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
