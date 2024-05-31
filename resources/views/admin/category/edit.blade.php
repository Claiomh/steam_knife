@include('admin.header')
<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <form method="post" action="{{route('admin.category.update', $category->id)}}">
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="text" aria-describedby="title" value="{{$category->title}}">
                        @error('title')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text"class="form-control" name="description" id="description" value="{{$category->description}}">
                        @error('description')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="text" class="form-control" name="image" id="image" value="{{$category->image}}">
                        @error('image')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="is_active" class="form-label">Active category</label>
                        <input type="checkbox" class="form-control" value="1" name="is_active" @checked(old('is_active', $category->is_active)) {{$category->is_active === 1 ? 'checked' : ''}}>
                        @error('is_active')
                        {{ $message }}
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
@include('admin.footer')
