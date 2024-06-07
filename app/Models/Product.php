<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
    protected $fillable = [
        'title',
        'category_id',
        'attribute_id',
        'content',
        'slug',
        'image',
        'price',
        'count',
        'is_active',
    ];
}
