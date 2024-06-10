@include('public.layouts.header')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Оплата заказа #{{ $order->id }}</div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <p>Имя клиента: {{ $order->customer_name }}</p>
                    <p>Email клиента: {{ $order->customer_email }}</p>
                    <p>Статус заказа: {{ $order->status }}</p>
                    <p>Общая сумма: {{ $order->orderItems->sum(function($item) { return $item->quantity * $item->price; }) }} руб.</p>

                    <form method="POST" action="{{ route('public.order.payment.process', $order->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Оплатить заказ</button>
                        <a href="{{ route('public.order.index') }}" class="btn btn-secondary">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('public.layouts.footer')
