<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('admin.product.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
                'title' => 'string|required',
                'category_id' => 'integer|required',
                'price' => 'integer|required',
                'description' => 'string|required',
                'count' => 'integer|required',
                'slug' => 'string|unique:categories',
                'image' => 'string|nullable',
            ]
        );
        Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'count' => $request->count,
            'slug' => Str::slug($request->title),
            'image' => $request->image,

        ]);
        return redirect()->route('admin.product.index');


    }

//    public function show(Category $category) {}
    public function edit(Product $product)
    {
        $categories = Category::where('is_active', 1)->get();
        return view('admin.product.edit', compact('product', 'categories'));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'string|required',
            'category_id' => 'integer|required',
            'price' => 'integer|required',
            'description' => 'string|required',
            'count' => 'integer|required',
            'slug' => 'string|unique:categories',
            'image' => 'string|nullable',
        ]);
        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'count' => $request->count,
            'slug' => Str::slug($request->title),
            'image' => $request->image,
        ]);
        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully');
    }


    public function delete(Product $product)
    {
        $product = Product::withTrashed()->find($product->id);
        $product->delete();
    }
}
