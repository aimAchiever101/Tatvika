<?php

namespace App\Models;
use App\Models\OrderItem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'tracking_no',
        'fullname',
        'email',
        'phone',
        'pincode',
        'address',
        'status_message',
        'payment_mode',
        'payment_id'
    ];

    public function orderItems(): HasMany
    {
                                            // 'foreign_key','local_key or primary key'
        return $this->hasMany(OrderItem::class, 'order_id','id');
    }
}
