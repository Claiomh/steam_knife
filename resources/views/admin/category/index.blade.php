@include('admin.header')
<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <h1>Categories</h1>
                        </div>
                        <div class="col">
                            <a class="btn btn-success" href="{{route('admin.category.create')}}">Create new category</a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">


                    @foreach($categories as $category)
                        <div class="row mb-3">
                            <div class="col-2">{{$category->id}}</div>
                            <div class="col-2">{{$category->title}}</div>
                            <div class="col-2">{{$category->image}}</div>
                            <div class="col-2">{{$category->slug}}</div>
                            <div class="col-2">{{$category->description}}</div>
                            <div class="col-2">
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="{{route('admin.category.edit', $category->id)}}" class="btn btn-warning">Edit</a>
                                    <form action="{{route('admin.category.destroy', $category->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger type=" submit
                                        ">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@include('admin.footer')
