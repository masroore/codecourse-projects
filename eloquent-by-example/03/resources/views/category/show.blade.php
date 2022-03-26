<h2>{{ $category->title }}</h2>

@if ($products->count())
    @foreach ($products as $product)
        <div class="product">
            <h3>{{ $product->title }}</h3>
            <p>£{{ number_format($product->price, 2) }}</p>
        </div>
    @endforeach

    {{ $products->links() }}
@endif
