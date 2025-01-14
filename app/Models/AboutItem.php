<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutItem extends Model
{
    protected $table = 'about_items';
    protected $primaryKey = 'id';
     protected $fillable = [
          'about_item',
      ];
      use HasFactory;
}
