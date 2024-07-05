<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'quantity', 'price', 'category_id'];

    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
