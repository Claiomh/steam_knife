@include ('public.layouts.header')

<div class="max-w-7xl mx-auto mt-10">
    @if (session('success'))
        <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-white shadow-md rounded my-6 overflow-hidden">
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-100 font-bold uppercase text-sm text-gray-600">ID</th>
                <th class="py-2 px-4 bg-gray-100 font-bold uppercase text-sm text-gray-600">Имя клиента</th>
                <th class="py-2 px-4 bg-gray-100 font-bold uppercase text-sm text-gray-600">Email клиента</th>
                <th class="py-2 px-4 bg-gray-100 font-bold uppercase text-sm text-gray-600">Продукты</th>
                <th class="py-2 px-4 bg-gray-100 font-bold uppercase text-sm text-gray-600">Общая сумма</th>
                <th class="py-2 px-4 bg-gray-100 font-bold uppercase text-sm text-gray-600">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $order->id }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $order->customer_name }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $order->customer_email }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">
                        <ul>
                            @foreach($order->orderItems as $item)
                                <li>{{ $item->product->name }} ({{ $item->quantity }} x {{ $item->price }} руб.)</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="py-2 px-4 border-b border-gray-200">
                        {{ $order->orderItems->sum(function($item) { return $item->quantity * $item->price; }) }} руб.
                    </td>
                    <td class="py-2 px-4 border-b border-gray-200">
                        <a href="{{ route('public.order.show', $order->id) }}" class="text-blue-600 hover:text-blue-900">Просмотр</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('public.layouts.footer')

