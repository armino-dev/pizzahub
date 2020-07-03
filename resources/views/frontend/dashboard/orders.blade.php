@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h2>Welcome, {{$user->name}}!</h2>
    <p>This is your very primitive dashboard<p>
    <h3>Orders Summary</h3>

    @if ($orders->count())        
        <table class="table table-striped">
        @foreach ($orders as $o)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$o->created_at->diffForHumans()}}</td>
                <td>{{$currencySymbol}} {{$o->total * $conversionRate}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2">Total spent:</td>
            <td>{{$currencySymbol}} {{$orders->sum('total') * $conversionRate}}</td>
        </tr>
        </table>
    @endif    
    
    
    <div class="d-flex justify-content-between">
    
    </div>
</div>
@endsection