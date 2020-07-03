@extends('layouts/app')


@section('content')
<div class="container product">

    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex">
            <h2>{{$product->name}}</h2>
        </div>
        <div class="d-flex">
            <div class="row">
                <div class="col">
                    @include('frontend.currency')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-lg-6 image mb-3">
            @if ($product->image)
            <img class="w-100" src="/images/{{ $product->image }}" alt="{{ $product->name  }}">
            @else
            <img class="w-100"
                src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' version='1.1' width='160' height='120' xmlns:xlink='http://www.w3.org/1999/xlink'%3E%3Crect class='shape' x='0' y='0' width='160' height='120' fill='%23fa5'%3E%3C/rect%3E%3Ctext x='80' y='60' text-anchor='middle'%3ENo Image Yet%3C/text%3E%3C/svg%3E"
                alt="">
            @endif
        </div>
        <div class="col-xs-12 col-lg-6">
            <form id="basket-form" method="POST" action="{{ route('basket.item.store') }}"
                enctype="multipart/form-data">
                @csrf
                <input name="product-id" type="hidden" id="product-id" value="{{ $product->id }}" />
                <input name="product-price" type="hidden" id="product-price" value="{{ $product->price }}" />
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row mb-2">
                    <div class="col-12">
                        <h4>Description</h4>
                        <p>
                            {{ $product->description }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="quantity">
                            <div class="before"><span>Quantity:</span></div>
                            <div class="after">
                                <input name="item-quantity" type="number" id="item-quantity" value="1"
                                    aria-label="Quantity" min=1 max=100 />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="price">
                            <div class="before"><span>Price ({{$currencySymbol}}):</span></div>
                            <div class="after"><span id="item-price">{{ number_format($product->price * $conversionRate, 2) }}</span></div>
                        </div>
                    </div>
                </div>
                <div class="action">
                    <a href="{{route('products.show', Str::slug($category->name))}}" class="btn btn-secondary btn-lg" title="Back">
                        <i class="fas fa-arrow-alt-circle-left"></i>
                    </a>
                    <a href="#" id="btn-add-to-basket" class="btn btn-primary btn-lg" title="Add to cart">
                        <i class="fas fa-shopping-basket"></i> Add to basket
                    </a>
                    <a href="#" id="btn-quantity-down" class="btn btn-outline-dark btn-lg" title="Decrease quantity">
                        <i class="fas fa-minus-circle"></i>
                    </a>
                    <a href="#" id="btn-quantity-up" class="btn btn-outline-dark btn-lg" title="Increase quantity">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection