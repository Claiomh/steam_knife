<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Метод для отображения формы создания заказа
    public function create()
    {
        $cart = Cart::where('user_id', auth()->id())->first();
        return view('public.order.create', compact('cart'));
    }

    // Метод для сохранения заказа
    public function store(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
        ]);

        // Получение корзины пользователя
        $cart = Cart::where('user_id', auth()->id())->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Корзина пуста.');
        }

        // Создание заказа
        $order = Order::create([
            'user_id' => auth()->id(),
            'customer_name' => $validatedData['customer_name'],
            'customer_email' => $validatedData['customer_email'],
        ]);

        // Создание элементов заказа на основе товаров в корзине
        foreach ($cart->cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Очистка корзины
        $cart->cartItems()->delete();

        // Редирект с успешным сообщением
        return redirect()->route('orders.index')->with('success', 'Заказ успешно создан!');
    }

    // Метод для отображения списка заказов
    public function index()
    {
        $orders = Order::with('orderItems.product')->where('user_id', auth()->id())->get();
        return view('orders.index', compact('orders'));
    }

}
