<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    // Метод для сохранения заказа
    public function update(Request $request, Order $order)
    {
        // Валидация данных
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'status' => 'required|in:pending,processing,completed,cancelled,paid',
        ]);

        $order->update($request->all());

        // Редирект с успешным сообщением
        return redirect()->route('admin.order.index')->with('success');
    }

    public function update_status(Request $request, Order $order) {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled,paid',
        ]);
        $order->update($request->all());
        return redirect()->route('public.order.index')->with('success');


    }
    public function edit(Order $order) {
        return view('admin.order.edit', compact('order'));
    }


    // Метод для отображения списка заказов
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order) {
        $orderItems = OrderItem::where('order_id' == $order->id);
        return view('admin.order.show', compact('order',  'orderItems'));
    }
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.order.index')->with('success', 'Category deleted successfully');

    }

    public function delete(Order $order)
    {
        $order = Order::withTrashed()->find($order->id);
        $order->delete();
    }

}
