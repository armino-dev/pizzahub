@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2>Welcome, {{$user->name}}!</h2>
        <p>This is your very primitive dashboard<p>
        <h3>Summary</h3>
        <p>You have a made a total of {{$orders->count()}} food orders with us and
            you spent {{$orders->sum('total')}} euros.
        </p>
        <div class="d-flex justify-content-between">
        <a 
            href="{{route('dashboard.profile')}}"
            class="btn btn-primary">
            <i class="fas fa-user"></i> View profile
        </a>
        <a href="{{route('dashboard.orders')}}"
            class="btn btn-primary">
            <i class="fas fa-clipboard-list"></i> View orders
        </a>
        </div>
    </div>
@endsection