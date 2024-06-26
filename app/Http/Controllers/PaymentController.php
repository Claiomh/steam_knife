<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Метод для отображения формы оплаты
    public function show(Order $order)
    {
        // Проверка, принадлежит ли заказ текущему пользователю
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('public.payment.show', compact('order'));
    }

    // Метод для обработки платежа
    public function process(Request $request, Order $order)
    {
        // Проверка, принадлежит ли заказ текущему пользователю
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Эмуляция отправки запроса на платёжный шлюз
        $response = Http::get('https://swapi.dev/api/people')->json();
        if ($response['results'][0]['name'] === 'Luke Skywalker' ) {
            // Обновление статуса заказа
            $order->update(['status' => 'paid']);
            return redirect()->route('public.order.index')->with('status', 'Оплата успешно проведена.');
        } else {
            return redirect()->back()->with('error', 'Ошибка при обработке платежа.');
        }

    }
}
