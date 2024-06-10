@include ('public.layouts.header')

<div class="max-w-lg mx-auto mt-10">
    @if ($cart && $cart->cartItems->isNotEmpty())
        <form action="{{ route('orders.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="customer_name">
                    Имя клиента
                </label>
                <input name="customer_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="customer_name">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="customer_email">
                    Email клиента
                </label>
                <input name="customer_email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="customer_email">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Товары в корзине
                </label>
                <ul class="list-disc pl-5">
                    @foreach($cart->cartItems as $item)
                        <li>{{ $item->product->name }} ({{ $item->quantity }} x {{ $item->product->price }} руб.)</li>
                    @endforeach
                </ul>
            </div>
            <div class="flex items-center justify-between mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Создать заказ
                </button>
            </div>
        </form>
    @else
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <p class="text-gray-700">Ваша корзина пуста.</p>
        </div>
    @endif
</div>

@include('public.layouts.footer')

