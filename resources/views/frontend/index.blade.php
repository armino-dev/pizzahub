@include('frontend.menu')

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
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @foreach ($menus as $key=>$menu)    
    <div class="d-flex justify-content-between mb-3">
        <div class="d-flex">
            <h2>{{ $key }}</h2>
        </div>
        @if ($loop->first)
        <div class="d-flex">
            <div class="row">
                <div class="col">
                    @include('frontend.currency')
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="row p-0 m-0">
        @foreach ($menu as $product)

        <?php $category = $product->category ?>
        @include ('frontend.card')

        @endforeach
    </div>
    @endforeach

    <div class="row p-0 m-0">
        <div class="col">
            more here
        </div>
    </div>
</div>