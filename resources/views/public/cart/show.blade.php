<div class="container">
    <h1>Shopping Cart</h1>
    @if(Auth::check())
        @foreach($cart as $item)
            <div class="row">
                <div class="col-md-8">
                    <h4>{{ $item->product->title }}</h4>
                    <p>Price: ${{ $item->product->price }}</p>
                    <p>Quantity: {{ $item->count }}</p>
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        @foreach($cart as $id => $details)
            <div class="row">
                <div class="col-md-8">
                    <h4>{{ $details['name'] }}</h4>
                    <p>Price: ${{ $details['price'] }}</p>
                    <p>Quantity: {{ $details['count'] }}</p>
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $id }}">
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
