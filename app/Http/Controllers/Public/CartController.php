<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;

        if (Auth::check()) {
            // Пользователь авторизован
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

                $cartItem = CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $product->id)
                    ->first();

                if ($cartItem) {
                    $cartItem->quantity += $quantity;
                    $cartItem->save();
                } else {
                    $cartItem = CartItem::create([
                        'cart_id' => $cart->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                    ]);
                }


        } else {
            // Пользователь не авторизован, используем сессии
            $cart = session()->get('cart', []);
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] += $quantity;
            } else {
                $cart[$product->id] = [
                    "title" => $product->title,
                    "quantity" => $quantity,
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
        $cartItems = [];
        $cart_total = 0;

        if (Auth::check()) {
            // Получаем корзину из базы данных
            $cart = Cart::with('items.product')->where('user_id', Auth::id())->first();
            if ($cart) {
                $cartItems = $cart->items;
                foreach ($cartItems as $item) {
                    $cart_total += $item->quantity * $item->product->price;
                }
            }
        } else {
            // Получаем корзину из сессии
            $cartItems = session()->get('cart', []);
            foreach ($cartItems as $item) {
                $cart_total += $item['quantity'] * $item['price'];
            }
        }

        return view('public.cart.show', compact('cartItems', 'cart_total'));
    }

    public function removeFromCart(Request $request)
    {
        if (Auth::check()) {
            // Пользователь авторизован
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $request->product_id)
                    ->delete();
            }
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
