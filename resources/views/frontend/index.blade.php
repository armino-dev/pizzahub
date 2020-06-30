<div class="container pt-5">
	

	<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
		Praesentium accusantium in, perferendis delectus dolor dolores blanditiis
		est magni molestias libero dolorum, ut sunt suscipit nihil debitis,
		esse impedit sapiente quaerat.
	</p>
	

	@auth
	<div class="text-danger">
		<p>Only authenticated users see this text.</p>
	</div>
    @endauth
    
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Thank you!</h5>
            <p>
                {{ session()->get('message') }}
            </p>
            <p>
            You can add more or you can 
            proceed to <a href="{{ route('checkout') }}" title="Checkout">checkout</a>.
            </p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <h2 class="mb-4">{{ $category->name }}</h2>
	<div class="row p-0 m-0">
		@foreach ($products as $product)
            @include ('frontend.card')
		@endforeach
	</div>
	<div class="row p-0 m-0">
		<div class="col">
			more here
		</div>
	</div>
</div>