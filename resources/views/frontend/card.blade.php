<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 p-0 p-md-3">
    <div class="mr-md-3 mb-3">
        <div class="card-listing">
            <div class="card-listing-header" style="position:relative;overflow:hidden">
            <a href="/{{ Str::slug($category->name) }}/{{ $product->slug }}" title="{{ $product->name }}">
                @if ( file_exists( public_path() . '/images/mobile/' . $product->image) )
                    <img class="w-100" src="/images/mobile/{{ $product->image }}" alt="{{ $product->name }}">
                @else
                    <img class="w-100" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' version='1.1' width='160' height='120' xmlns:xlink='http://www.w3.org/1999/xlink'%3E%3Crect class='shape' x='0' y='0' width='160' height='120' fill='%23fa5'%3E%3C/rect%3E%3Ctext x='80' y='60' text-anchor='middle'%3ENo Image Yet%3C/text%3E%3C/svg%3E" alt="">
                @endif
                </a>
                @if ($product->best_seller)
                    <div class="card-listing-featured">Best seller</div>
                @endif
                <div class="card-listing-price">
                    <span class="currency-symbol">{{ $currencySymbol }}</span>
                    <span class="text">{{ number_format($product->price * $conversionRate, 2) }}</span>
                </div>
            </div>
            <div class="card-listing-body">
                <div class="card-listing-name">
                    <h5><a href="#">{{ $product->name }}</a></h5>
                </div>
                <div class="card-listing-details">
                    <p>{{ $product->description }}</p>
                </div>
                <div class="card-listing-footer">
                    <div>
                        <a
                            href="/{{ Str::slug($category->name) }}/{{ $product->slug }}"
                            title="{{ $product->name }}"
                            class="btn btn-primary">Choose</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
