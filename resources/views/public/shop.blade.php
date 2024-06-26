@include ('public.layouts.header')
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            @include ('public.layouts.sidebar')
        </div>
        <div class="col-9">

            <div class="row">

                @foreach($products as $product)
                    <div class="col-4">
                        <div class="card" style="">
                            <img src="{{asset('storage/' . $product->image)}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->title}}</h5>
                                <p class="card-text">{{$product->description}}</p>
                                <p class="card-text">{{$product->price}}</p>
                                <a href="{{ route('public.product.show', ['category' => $product->category->slug, 'product' => $product->slug]) }}" class="btn btn-primary">Show</a>                            </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div>

</div>

<div>

</div>
@include('public.layouts.footer')
