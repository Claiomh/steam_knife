@include('admin.header')
<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a class="btn btn-success" href="{{route('admin.product.create')}}">Create new product</a>
                </div>
                <div class="container-fluid">


               @foreach($products as $product)
                    <div class="row mb-3">
                        <div class="col-2">{{$product->id}}</div>
                        <div class="col-2">{{$product->title}}</div>
                        <div class="col-2">{{$product->image}}</div>
                        <div class="col-2">{{$product->slug}}</div>
                        <div class="col-2">{{$product->description}}</div>
                        <div class="col-2">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <a href="{{route('admin.product.edit', $product->id)}}" class="btn btn-warning">Edit</a>
                                <form action="{{route('admin.product.destroy', $product->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
               @endforeach
                </div>
            </div>
        </div>
@include('admin.footer')
