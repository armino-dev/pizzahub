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
    
    <h3 class="mb-3">Delivery details</h3>
    <p class="mb-4">
        We need some data to make a delivery. Please enter your details below.<br />
        We promise we will not spam you, nor we'll share your details with third parties.
    </p>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    @if ($basket !== "null")

    <div class="d-flex">
    <form class="w-100 needs-validation" id="form-delivery-data" action="{{ route('basket.step2') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        name="email" 
                        placeholder="Email" 
                        value="{{ session()->has('order-detail') ? session()->get('order-detail')['email'] : old('email') }}"
                        required>
                </div>
                <div class="form-group col-6">
                    <label for="phone">Phone</label>
                    <input 
                        type="tel" 
                        class="form-control" 
                        id="phone" 
                        name="phone" 
                        placeholder="0733000000" 
                        value="{{ session()->has('order-detail') ? session()->get('order-detail')['phone'] : old('phone') }}"
                        required>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="name" 
                    name="name" 
                    placeholder="Some Name" 
                    value="{{ session()->has('order-detail') ? session()->get('order-detail')['name'] : old('name') }}"
                    required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input 
                    type="text" 
                    class="form-control" 
                    id="address" 
                    name="address" 
                    placeholder="Some street address"
                    value="{{ session()->has('order-detail') ? session()->get('order-detail')['address'] : old('address') }}"
                    required>
            </div>
            <div class="form-row">
                <div class="form-group col-6">
                    <label for="city">City</label>
                    <select id="city" class="form-control" name="city">
                        <option value="bucharest" selected>Bucharest</option>
                        <option value="bragadiru">Bragadiru</option>
                    </select>
                </div>
                <div class="form-group col-6">
                    <label for="zip">Zip</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="zip" 
                        name="zip" 
                        placeholder="000000"
                        value="{{ session()->has('order-detail') ? session()->get('order-detail')['zip'] : old('zip') }}"
                        required>
                </div>
            </div>
            <div class="d-flex">
                <p>
                    On the next screen you will have the posibility to review and place your order.
                </p>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" title="Finalize order">Next</a>
            </div>
        </form>
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