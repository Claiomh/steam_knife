@include('admin.header')
<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <form method="post" action="{{route('admin.product.update', $product->id)}}">
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="text" aria-describedby="title" value="{{$product->title}}">
                        @error('title')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Description</label>
                        <input type="text"class="form-control" name="content" id="content" value="{{$product->content}}">
                        @error('content')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="text" class="form-control" name="image" id="image" value="{{$product->image}}">
                        @error('image')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" id="price" value="{{$product->price}}">
                        @error('price')
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="count" class="form-label">Count</label>
                        <input type="number" class="form-control" name="count" value="{{$product->count}}" id="count">
                        @error('count')
                        @enderror
                    </div>
                    <select class="form-select" aria-label="Default select example" name="category_id">
                        @foreach($categories as $category)
                            <option {{$product->category_id === $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
@include('admin.footer')
