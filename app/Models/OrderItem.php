<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductColor;


class OrderItem extends Model
{
    use HasFactory;
    protected $table= 'order_items';
    protected $fillable = [
        'order_id',
        'product_id',
        'product_color_id',
        'quantity',
        'price'
    ];

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function productColor():BelongsTo
    {
        return $this->belongsTo(ProductColor::class,'product_color_id','id');
    }
}
