<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $count = $request->count ?? 1;

        if (Auth::check()) {
            // Пользователь авторизован
            $cart = Cart::updateOrCreate(
                ['user_id' => Auth::id(), 'product_id' => $product->id],
                ['count' => \DB::raw("count + $count")]
            );
        } else {
            // Пользователь не авторизован, используем сессии
            $cart = session()->get('cart', []);
            if (isset($cart[$product->id])) {
                $cart[$product->id]['count'] += $count;
            } else {
                $cart[$product->id] = [
                    "name" => $product->name,
                    "count" => $count,
                    "price" => $product->price,
                    "image" => $product->image
                ];
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function showCart()
    {
        $cart = [];
        if (Auth::check()) {
            // Получаем корзину из базы данных
            $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        } else {
            // Получаем корзину из сессии
            $cart = session()->get('cart', []);
        }

        return view('public.cart.show', compact('cart'));
    }

    public function removeFromCart(Request $request)
    {
        if (Auth::check()) {
            // Пользователь авторизован
            Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->delete();
        } else {
            // Пользователь не авторизован, используем сессии
            $cart = session()->get('cart', []);
            if (isset($cart[$request->product_id])) {
                unset($cart[$request->product_id]);
                session()->put('cart', $cart);
            }
        }

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

}
