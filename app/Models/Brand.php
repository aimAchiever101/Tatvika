<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;

    protected $table ='brands';

    protected $fillable = [
        'name',
        'slug',
        'status',
        'category_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }

}
