@include('public.layouts.header')

<h1>Your Cart</h1>
@if (count($cartItems) > 0)
    <table>
        <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cartItems as $item)
            <tr>
                <td>{{ $item->product->title }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->product->price }}</td>
                <td>{{ $item->quantity * $item->product->price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h2>Total: ${{ $cart_total }}</h2>
    <a href="{{route('public.order.create')}}">Create order</a>
@else
    <p>Your cart is empty.</p>
@endif
@include('public.layouts.footer')


