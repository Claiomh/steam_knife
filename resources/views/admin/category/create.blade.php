@include('admin.header')
<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <form method="post" action="{{route('admin.category.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="text" aria-describedby="title">
                        @error('title')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text"class="form-control" name="description" id="exampleInputPassword1">
                        @error('description')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                        @error('image')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="is_active" class="form-label">Active category</label>
                        <input type="checkbox" class="form-control" name="is_active" value="1">
                        @error('is_active')
                        {{ $message }}
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
@include('admin.footer')
