@include('admin.header')
<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <a class="btn btn-success" href="{{route('admin.category.create')}}">Create new category</a>
                </div>
                <div class="container-fluid">


                    @foreach($orders as $order)
                        <div class="row mb-3">
                            {{$order->id}}

                            <a href="{{route('admin.order.edit', $order->id)}}" class="btn btn-warning">Edit</a>
                            <form action="{{route('admin.order.destroy', $order->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger type="submit">Delete</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@include('admin.footer')
