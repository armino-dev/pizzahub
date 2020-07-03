@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <h2>Welcome, {{$user->name}}!</h2>
    <p>This is your very primitive dashboard<p>
    <h3>Profile</h3>

    <div class="d-flex justify-content-between">
        <ul class="list-group">
            <li class="list-group-item">Name: {{$user->name}}</li>
            <li class="list-group-item">Email: {{$user->email}}</li>
            <li class="list-group-item">Member since: {{$user->created_at->diffForHumans()}}</li>            
        </ul>
    </div>
</div>
@endsection