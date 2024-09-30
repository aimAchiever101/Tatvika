<?php

namespace App\Models;
use App\Models\productColor;
use App\Models\productImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'brand',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'quantity',
        'trending',
        'featured',
        'status',
        'meta_title',
        'meta_keyword',
        'meta_description',
    ];
    // 
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    // creating relation function
    
    public function productImages(){
        return $this->hasMany(productImage::class, 'product_id','id');
    }
    // relation for colors and qunatity with product it will all the product colors for editing them
    public function productColors()
    {
        return $this->hasmany(ProductColor::class,'product_id','id');
    }
}
