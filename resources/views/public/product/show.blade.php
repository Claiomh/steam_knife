@include ('public.layouts.header')
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <img src="{{asset('storage/'.$product->image)}}" class="card-img-top" alt="...">
        </div>
        <div class="col-6">
            {{$product->id}}
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="form-group">
                    <label for="count">Quantity:</label>
                    <input type="number" name="count" id="quantity" value="1" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        </div>
    </div>
</div>
<div>

</div>

<div>

</div>
@include('public.layouts.footer')
