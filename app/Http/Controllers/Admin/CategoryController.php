<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {

        $request->validate([
                'title' => 'string|required',
                'description' => 'string|nullable',
                'slug' => 'string|unique:categories,slug',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]
        );
        $fileName = '';
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images/categories', $fileName);
        }
        Category::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'image' => $fileName,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.category.index');


    }

//    public function show(Category $category) {}
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {

        $request->validate([
                'title' => 'string|required',
                'description' => 'string|nullable',
                'slug' => 'string|unique:categories',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'is_active' => 'boolean'
            ]
        );
        $category->update([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'image' => $request->image,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully');

    }

    public function delete(Category $category)
    {
        $category = Category::withTrashed()->find($category->id);
        $category->delete();
    }
}
