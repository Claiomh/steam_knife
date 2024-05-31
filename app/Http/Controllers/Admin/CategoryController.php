<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }
    public function create() {
        return view('admin.category.create');
    }
    public function store(Request $request) {

        $request->validate([
            'title' => 'string|required',
            'description' => 'string|nullable',
            'slug' => 'string|unique:categories',
            'image' => 'string|nullable',
                ]
        );
        Category::create([
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
            'image' => $request->image,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.category.index');



    }
//    public function show(Category $category) {}
    public function edit(Category $category) {
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, Category $category) {

        $request->validate([
                'title' => 'string|required',
                'description' => 'string|nullable',
                'slug' => 'string|unique:categories',
                'image' => 'string|nullable',
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
    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully');

    }
    public function delete(Category $category) {
        $category = Category::withTrashed()->find($category->id);
        $category->delete();
    }
}
