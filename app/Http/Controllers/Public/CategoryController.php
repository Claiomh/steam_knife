<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {}
    public function show($id) {
        $category = Category::find($id);
        $products = $category->products;
        return view('public.category.show', compact('category', 'products'));
    }
}
