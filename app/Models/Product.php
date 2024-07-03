<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'quantity', 'price'];

    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
}
