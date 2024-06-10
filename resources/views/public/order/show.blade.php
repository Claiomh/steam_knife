@include('public.layouts.header')

<div class="max-w-7xl mx-auto mt-10">
    <div class="bg-white shadow-md rounded my-6 overflow-hidden">
        <div class="px-6 py-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Заказ #{{ $order->id }}</h2>
            <p class="text-gray-600">Имя клиента: {{ $order->customer_name }}</p>
            <p class="text-gray-600">Email клиента: {{ $order->customer_email }}</p>
            <h3 class="font-semibold text-lg text-gray-800 leading-tight mt-4">Продукты:</h3>
            <ul class="list-disc pl-5">
                @foreach($order->orderItems as $item)
                    <li>{{ $item->product->name }} ({{ $item->quantity }} x {{ $item->price }} руб.)</li>
                @endforeach
            </ul>
            <p class="text-gray-600 mt-4">Общая сумма: {{ $order->orderItems->sum(function($item) { return $item->quantity * $item->price; }) }} руб.</p>
            <p class="text-gray-600 mt-4">Статус заказа: {{ $order->status }}</p>

            @if ($order->status == 'pending' || $order->status == 'processing')
                <a href="{{ route('public.order.payment.show', $order->id) }}" class="btn btn-primary">Оплатить заказ</a>
            @endif

            <a href="{{ route('public.order.index') }}" class="btn btn-secondary">Вернуться к заказам</a>
        </div>
    </div>
</div>

@include('public.layouts.footer')
