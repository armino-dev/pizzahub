@extends('layouts/app')


@section('content')
<div class="container-fluid mt-5">
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex">
            <h2>Checkout</h2>
        </div>
        <div class="d-flex">
            <div class="row">
                <div class="col">
                    @include('frontend.currency')
                </div>
            </div>
        </div>
    </div>
    @if ($basket !== "null" && $basket->getQuantity() > 0)

    <?php $items = $basket->getItems(); ?>
    
    @include('frontend.checkout-table')

    <div class="d-flex">
        <p>
            If you are ok with this click next to add a delivery address. 
            The delivery cost will be calculated on the next step.
        </p>
    </div>
    <div class="d-flex justify-content-end">
        <a href="{{route('basket.step1')}}" class="btn btn-primary btn-checkout-address" title="Enter delivery address">Next</a>
    </div>
    @else
    <p>Your shopping basket is empty. <br />Please add something in it first.</p>
    <p>
        <a href="{{route('home')}}" title="Back to shopping" class="btn btn-primary">Back to shopping
        </a>
    </p>
    @endif
</div>
@endsection