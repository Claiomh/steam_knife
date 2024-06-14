<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
//use http\Env\Request;
use Illuminate\Http\Request;


class PublicController extends Controller
{
    public function index() {
        return view('public.index');
    }
    public function shop() {
        $categories = Category::all();
        $products = Product::where('is_active', 1)
            ->with('category')
            ->get();
        return view('public.shop', compact('categories', 'products'));
    }

    public function search(Request $request) {
        $search = $request->search;
        $products = Product::where('is_active', 1)
            ->where('title', 'LIKE', '%'.$search.'%')
            ->with('category')
            ->get();
        return view('public.search.index', compact('products'));


    }
}
