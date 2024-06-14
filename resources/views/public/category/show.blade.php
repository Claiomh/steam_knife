@include('public.layouts.header')
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <form method="GET" action="{{ route('public.category.show', $category->slug) }}" class="mb-3">
                <div class="form-row">
                    <div class="form-group">
                        <label for="price_min">Min Price</label>
                        <input type="number" class="form-control" id="price_min" name="price_min" value="{{ request('price_min') }}">
                    </div>
                    <div class="form-group">
                        <label for="price_max">Max Price</label>
                        <input type="number" class="form-control" id="price_max" name="price_max" value="{{ request('price_max') }}">
                    </div>
                    <div class="form-group">
                        <label>Attributes</label>
                        @foreach($attributes as $attribute)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="attribute_{{ $attribute->id }}" name="attribute_id[]" value="{{ $attribute->id }}" {{ in_array($attribute->id, request('attribute_id', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="attribute_{{ $attribute->id }}">{{ $attribute->title }}</label>
                            </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                    <div class="form-group col-md-3 align-self-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-9">
            <form action="{{ route('public.category.show', $category->slug) }}" method="GET">
                <div class="form-group">
                    <label for="sort">Sort By</label>
                    <select class="form-control" id="sort" name="sort">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name (A-Z)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                        <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price (Low to High)</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
                    </select>
                </div>
                <input type="hidden" name="price_min" value="{{ request('price_min') }}">
                <input type="hidden" name="price_max" value="{{ request('price_max') }}">
                @foreach(request('attribute_id', []) as $attributeId)
                    <input type="hidden" name="attribute_id[]" value="{{ $attributeId }}">
                @endforeach
                <div class="form-group d-flex">
                    <button type="submit" class="btn btn-primary">Sort</button>
                </div>
            </form>
            <h1>{{ $category->title }}</h1>

            <div class="row">
                @if(count($products) > 0)
                    @foreach($products as $product)
                        <div class="col-4">
                            <div class="card">
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->title }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <p class="card-text">{{ $product->price }}</p>

                                    <a href="{{ route('public.product.show', ['category' => $category->slug, 'product' => $product->slug]) }}" class="btn btn-primary">Show</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h2>Category is empty</h2>
                @endif
            </div>

            <!-- Пагинация -->
            <div class="d-flex justify-content-center">
                {{ $products->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>
@include('public.layouts.footer')
