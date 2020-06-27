@extends('layouts/app')

@section('content')
	@switch(Route::currentRouteName())
		@case('home')
			@include('frontend.index')
		@break		
		@case('about')
		@break
		@case('contact')
		@break
	@endswitch
@endsection