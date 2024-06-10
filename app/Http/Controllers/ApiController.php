<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

use Faker\Factory as Faker;


class ApiController extends Controller
{
    public function index()
    {
        $faker = Faker::create();

        $responce = Http::get('https://swapi.dev/api/people')->json();
        dd($responce);

        foreach ($responce['results'] as $people) {
            User::create([
                'name' => $people['name'],
                'email' => $faker->email(),
                'password' => $faker->password(),
            ]);
        }

    }
    public function process(Request $request)
    {
        // Логика эмуляции (в реальном мире здесь будет взаимодействие с платёжным провайдером)
        $order_id = $request->input('order_id');
        $amount = $request->input('amount');
        dd(request('amount'));
        // Здесь можно добавить любую логику проверки и обработки платежа
        if ($order_id && $amount > 0) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error'], 400);
        }
    }
}
