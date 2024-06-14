<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

use Faker\Factory as Faker;
use Illuminate\Support\Str;


class ApiController extends Controller
{
    public function index()
    {
        $faker = Faker::create();

        $responce = Http::get('https://swapi.dev/api/people')->json();
        dd($responce);

//        foreach ($responce['results'] as $people) {
//            User::create([
//                'name' => $people['name'],
//                'email' => $faker->email(),
//                'password' => $faker->password(),
//            ]);
//        }

    }
    public function process(Request $request)
    {
        // Логика эмуляции (в реальном мире здесь будет взаимодействие с платёжным провайдером)
        $order_id = $request->input('order_id');
        $amount = $request->input('amount');
        // Здесь можно добавить любую логику проверки и обработки платежа
        if ($order_id && $amount > 0) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error'], 400);
        }
    }
    public function updateFromApi() {
        $responce = Http::get('http://localhost:5000/api/products')->json();
        foreach ($responce['results'] as $product) {
            $product = Product::updateOrCreate(
                ['id' => $product['id']],
                ['title' => $product['title'],
                'description' => $product['description'],
                'category_id' => $product['category_id'],
                'attribute_id' => $product['attribute_id'],
                'price' => $product['price'],
                'quantity' => $product['quantity'],
                'slug' => Str::slug($product['title']->title),
                'is_active' => $product['quantity'] > 1 ? 1 : 0,
            ]
            );
        }
        return view('admin.product.index');

    }
}
