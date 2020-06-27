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