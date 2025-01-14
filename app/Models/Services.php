<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'service_icon',
        'service_name',
        'short_description',
        'long_description',
    ];
}
