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

    @php
    $items = $basket->getItems();
    $vatTax = config('settings.vat')/100;
    $deliveryCost = config('settings.delivery_cost')[$orderDetail['city']];    
    $grandTotal = ($basket->getTotal() + $deliveryCost) * $conversionRate;    
    $vat = $grandTotal - $grandTotal/(1 + $vatTax);
    @endphp

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product</th>
                <th scope="col">Price ({{ $currencySymbol }})</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $key => $item)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>
                    {{ $item['name'] }} x <span id="quantity-{{$key}}"><strong>{{ $item['quantity'] }}</strong></span><br />Price: <span class="currency-symbol">{{ $currencySymbol }}</span>
                    <span id="price-{{$key}}">{{ number_format($item['price'] * $conversionRate, 2) }}</span>                    
                </td>
                <td>
                    <span
                        id="price-total-{{$key}}">{{ number_format($item['price'] * $item['quantity'] * $conversionRate, 2) }}</span>
                    <br /><br />
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-right"><strong>VAT {{config('settings.vat')}}%:</strong></td>
                <td>
                    {{ $currencySymbol }}
                    <span id="vat-cost">{{number_format($vat, 2)}}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-right"><strong>Delivery cost:</strong></td>
                <td>
                    {{ $currencySymbol }}
                    <span id="delivery-cost">{{number_format($deliveryCost * $conversionRate, 2)}}</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-right"><strong>Grand total:</strong></td>
                <td>
                    {{ $currencySymbol }}
                    <span id="grand-total">{{ number_format($grandTotal, 2) }}</span>
                </td>
            </tr>
        </tfoot>
    </table>
    <div class="container-fluid">
        <h3>Delivery details:</h3>
        <ul class="list-group">
            <li class="list-group-item">Name: {{$orderDetail['name']}}</li>
            <li class="list-group-item">Phone: {{$orderDetail['phone']}}</li>
            <li class="list-group-item">Email: {{$orderDetail['email']}}</li>
            <li class="list-group-item">Address: {{$orderDetail['address']}}, {{$orderDetail['city']}}, {{$orderDetail['zip']}}</li>            
        </ul>
        <p class="mt-3">
            If everything is fine place the order, otherwise you may go back and modify your shopping basket.
        </p>
    </div>
    <div class="d-flex justify-content-between">
        <a href="{{route('basket')}}" class="btn btn-primary"
            title="Return to basket">Back</a>
        <a 
            href="{{route('order.store')}}" 
            class="btn btn-primary" 
            id="btn-place-order"
            title="Enter delivery address">Place order</a>
    </div>
    @endif
</div>
@endsection