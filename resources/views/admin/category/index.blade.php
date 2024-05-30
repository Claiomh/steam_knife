@include('admin.header')
<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div>
                    <a href="{{route('admin.category.create')}}">Create new category</a>
                </div>
               @foreach($categories as $category)
                   <div>{{$category->title}}</div>
               @endforeach
            </div>
        </div>
@include('admin.footer')
