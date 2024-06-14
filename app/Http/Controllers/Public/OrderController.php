<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderCreated;
use App\Notifications\OrderCreatedAdmin;
use App\Notifications\OrderCancelled;
use App\Notifications\OrderCancelledAdmin;

class OrderController extends Controller
{
    // Метод для отображения формы создания заказа
    public function create()
    {
        $user = User::where('id', auth()->id())->first();
        $cart = Cart::where('user_id', auth()->id())->first();
        return view('public.order.create', compact('cart', 'user'));
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
        $adminEmail = 'riftgofen@gmail.com'; // Укажите email администратора
        \Notification::route('mail', $adminEmail)->notify(new OrderCreatedAdmin($order));


        Auth::user()->notify(new OrderCreated($order));

        // Редирект с успешным сообщением
        return redirect()->route('public.order.index')->with('success', 'Заказ успешно создан!');
    }


    // Метод для отображения списка заказов
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('orderItems')->get();
        return view('public.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $orderItems = OrderItem::where('order_id' == $order->id);
        return view('public.order.show', compact('order', 'orderItems'));
    }

    public function cancel(Order $order)
    {
        if (Auth::user()->usertype != 'admin') {
            if ($order->user_id !== Auth::id() || $order->status !== 'pending') {
                return redirect()->back()->with('error', 'Невозможно отменить заказ.');
            }
            $order->update(['status' => 'canceled']);
            $adminEmail = 'riftgofen@gmail.com'; // Укажите email администратора
            \Notification::route('mail', $adminEmail)->notify(new OrderCancelledAdmin($order));
        }
        // Обновление статуса заказа на "отменен"
        $order->update(['status' => 'canceled']);
        \Notification::route('mail', $order->customer_email)->notify(new OrderCancelled($order));

        foreach ($order->orderItems as $orderItem) {
            $product = $orderItem->product;
            $product->quantity += $orderItem->quantity;
            $product->save();
        }

        return redirect()->route('public.order.index')->with('success', 'Заказ успешно отменен.');
    }

}
