<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table='categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',
    ];
    // creating a function for creating a connection between these product and category using this function we will store data of product
    public function products(){
        return $this->hasMany(Product::class, 'category_id','id');
    }

    public function brands(){
        return $this->hasMany(Brand::class, 'category_id','id')->where('status','0');
    }
}
