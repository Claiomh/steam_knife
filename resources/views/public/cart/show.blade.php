@include('public.layouts.header')

<h1>Your Cart</h1>
@if (count($cartItems) > 0)
    <table>
        <thead>
        <tr>
            <th>Название</th>
            <th>Количество</th>
            <th>Цена</th>
            <th>Итого</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cartItems as $item)
            <tr>
                <td>{{ $item['title'] }}</td>
                <td>
                    <form action="{{ route('cart.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                        <button type="submit">Обновить</button>
                    </form>
                </td>
                <td>{{ $item['price'] }}</td>
                <td>{{ $item['total'] }}</td>
                <td>
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                        <button type="submit">Удалить</button>
                    </form>
                </td>
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


