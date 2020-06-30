@extends('layouts/app')

@section('content')
    @switch(Route::currentRouteName())
        @case('products.show')
		@case('home')
			@include('frontend.index')
		@break		
		@case('about')
		@break
	@endswitch
@endsection