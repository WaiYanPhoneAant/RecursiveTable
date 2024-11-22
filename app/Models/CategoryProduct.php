<?php

namespace App\Models;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $table = 'category_products';
    protected $fillable = ['category_id', 'product_id'];
    public function products(){
        return $this->belongsTo(Product::class);
    }
    public function category(){
        //
    }
}
