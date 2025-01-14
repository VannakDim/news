<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'title',
        'image',
        'short_description',
        'long_description',
        'more_description',
    ];

    public function items(){
        return $this->hasMany(AboutItem::class);
    }
}
