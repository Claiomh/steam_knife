<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class PublicController extends Controller
{
    public function index() {
        return view('public.index');
    }
    public function shop() {
        $categories = Category::all();
        $products = Product::paginate(12);
        return view('public.shop', compact('categories', 'products'));
    }
}
