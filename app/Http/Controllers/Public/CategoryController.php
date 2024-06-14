<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index() {}
    public function show(Request $request, $slug) {
        $attributes = Attribute::all();
        $category = Category::where('slug', $slug)->first();
        $products = $category->products()->where('is_active', 1);
        if (!$category) {
            return redirect()->back()->with('error', 'Категория не найдена.');
        }
        // Применение фильтров по цене
        if ($request->filled('price_min')) {
            $products->where('price', '>=', $request->input('price_min'));
        }
        if ($request->filled('price_max')) {
            $products->where('price', '<=', $request->input('price_max'));
        }

        // Применение фильтра по id атрибута
        if ($request->filled('attribute_id')) {
            $attributeIds = $request->input('attribute_id');
            $products->whereIn('attribute_id', $attributeIds);
        }


        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            switch ($sort) {
                case 'name':
                    $products->orderBy('title', 'asc');
                    break;
                case 'name_desc':
                    $products->orderBy('title', 'desc');
                    break;
                case 'price':
                    $products->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $products->orderBy('price', 'desc');
                    break;
            }
        } else {
            // Сортировка по умолчанию
            $products->orderBy('title', 'asc');
        }

        $products = $products->paginate(12);
        return view('public.category.show', compact('category', 'products', 'attributes'));
    }

}
