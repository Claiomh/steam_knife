@include ('public.layouts.header')

<div class="max-w-lg mx-auto mt-10">
    @if ($cart && $cart->cartItems->isNotEmpty())
        <form action="{{ route('public.order.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <input type="hidden" value="{{$user->id}}">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="customer_name">
                    Имя клиента
                </label>
                <input name="customer_name" type="text"  value="{{$user->name}}" id="customer_name">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="customer_email">
                    Email клиента
                </label>
                <input name="customer_email" type="email" value="{{$user->email}}" id="customer_email">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="customer_email">
                    Email клиента
                </label>
                <input name="customer_email" type="email" value="{{$user->email}}" id="customer_email">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Товары в корзине
                </label>
                <ul class="list-disc pl-5">
                    @foreach($cart->cartItems as $item)
                        <li>{{ $item->product->title }} ({{ $item->quantity }} x {{ $item->product->price }} $.)</li>
                    @endforeach
                </ul>
            </div>
            <div class="">
                <button type="submit" class="btn btn-success">
                    Create order
                </button>
            </div>
        </form>
    @else
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <p class="text-gray-700">your cart is empty</p>
        </div>
    @endif
</div>

@include('public.layouts.footer')

