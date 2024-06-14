@foreach($categories as $category)
    <a href="{{ route('public.category.show', ['category' => $category->slug]) }}">{{$category->title}}</a>
@endforeach
