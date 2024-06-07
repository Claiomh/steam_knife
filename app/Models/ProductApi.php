<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductApi extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'category_id',
        'attribute_id',
        'content',
        'image',
        'price',
        'quantity',
    ];
}
