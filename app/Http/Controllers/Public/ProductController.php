<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    public function index() {}


    public function show(Category $category, Product $product) {
        return view('public.product.show', compact('product', 'category'));
//        dd($product);
    }
}
