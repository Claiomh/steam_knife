<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();
        $products = Product::all();
        return view('admin.product.index', compact('products', 'attributes'));
    }


    public function create()
    {
        $attributes = Attribute::all();
        $categories = Category::where('is_active', 1)->get();
        return view('admin.product.create', compact('categories', 'attributes'));
    }


    public function store(Request $request)
    {
        $request->validate([
                'title' => 'string|required',
                'category_id' => 'integer|required',
                'attribute_id' => 'integer|required',
                'price' => 'integer|required',
                'description' => 'string|required',
                'quantity' => 'integer|required',
                'slug' => 'string|unique:categories',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]
        );
        $path = '';
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images/products', $fileName);
            $path = 'images/products/' . $fileName;
        }
        Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'attribute_id' => $request->attribute_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'slug' => Str::slug($request->title),
            'image' => $path,

        ]);
        return redirect()->route('admin.product.index');


    }

//    public function show(Category $category) {}
    public function edit(Product $product)
    {
        $attributes = Attribute::all();
        $categories = Category::where('is_active', 1)->get();
        return view('admin.product.edit', compact('product', 'categories', 'attributes'));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'string|required',
            'category_id' => 'integer|required',
            'attribute_id' => 'integer|required',
            'price' => 'integer|required',
            'description' => 'string|required',
            'quantity' => 'integer|required',
            'slug' => 'string|unique:categories',
            'image' => 'string|nullable',
        ]);
        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'attribute_id' => $request->attribute_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
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
