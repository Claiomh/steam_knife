@include('admin.header')
<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <h1>Orders</h1>

                </div>
                <div class="container-fluid">


                    @foreach($orders as $order)
                        <div class="row mb-3">
                        <div class="col-1">{{$order->id}}</div>
                        <div class="col-3">{{$order->customer_name}}</div>
                        <div class="col-3">{{$order->customer_email}}</div>
                        <div class="col-2">{{$order->status}}</div>
<div class="col-3"> <a href="{{route('admin.order.edit', $order->id)}}" class="btn btn-warning">Edit</a>
    <form action="{{route('admin.order.destroy', $order->id)}}" method="post">
        @csrf
        @method('delete')
        <button class="btn btn-danger type="submit">Delete</button>
    </form></div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@include('admin.footer')
