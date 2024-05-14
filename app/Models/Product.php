<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'price',
        'image',
        'stock',
        'status',
        'is_favorite',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
