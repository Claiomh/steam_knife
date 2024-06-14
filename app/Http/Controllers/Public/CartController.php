<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

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
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->first();

            $currentQuantityInCart = $cartItem ? $cartItem->quantity : 0;

            if (($currentQuantityInCart + $quantity) > $product->quantity) {
                return redirect()->back()->with('error', 'Недостаточно товара на складе для добавления в корзину.');
            }
            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                ]);
            }
        } else {
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
            $cart = Cart::with('items.product')->where('user_id', Auth::id())->first();
            if ($cart) {
                foreach ($cart->items as $item) {
                    $cartItems[] = [
                        'id' => $item->product->id,
                        'title' => $item->product->title,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                        'total' => $item->quantity * $item->product->price
                    ];
                    $cart_total += $item->quantity * $item->product->price;
                }
            }
        } else {
            $sessionCart = session()->get('cart', []);
            foreach ($sessionCart as $id => $item) {
                $cartItems[] = [
                    'id' => $id,
                    'title' => $item['title'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['quantity'] * $item['price']
                ];
                $cart_total += $item['quantity'] * $item['price'];
            }
        }

        return view('public.cart.show', compact('cartItems', 'cart_total'));
    }

    public function removeFromCart(Request $request)
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $request->product_id)
                    ->delete();
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$request->product_id])) {
                unset($cart[$request->product_id]);
                session()->put('cart', $cart);
            }
        }

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

    public function updateCartQuantity(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $cartItem = CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $request->product_id)
                    ->first();

                if ($cartItem) {
                    $cartItem->quantity = $request->quantity;
                    $cartItem->save();
                }
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$request->product_id])) {
                $cart[$request->product_id]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
            }
        }

        return redirect()->back()->with('success', 'Product quantity updated successfully!');
    }
}
