@extends('layouts/app')


@section('content')    
<div class="container-fluid mt-5">
    <h2>Checkout</h2>
    @if ($basket) 
        <?php $items = $basket->getItems(); ?>               
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Product</th>
                  <th scope="col">Quantity</th>                  
                  <th scope="col">Price</th>
                </tr>
              </thead>
            <tbody>
            @foreach ($items as $key => $item)
               <tr>
                   <td>{{ $loop->index + 1 }}</td>
                   <td>{{ $item['name'] }}<br />{{ $item['price'] }}</td>
                   <td>
                       <button 
                            class="btn btn-outline-dark btn-minus-quantity mr-2"
                            data-id={{ $key }}>
                            <i class="fas fa-minus-circle"></i>
                       </button>
                       {{ $item['quantity'] }}
                       <button
                            class="btn btn-outline-dark btn-plus-quantity ml-2"
                            data-id={{ $key }}>
                            <i class="fas fa-plus-circle"></i>
                       </button>
                    </td>                   
                   <td>{{ $item['price'] * $item['quantity'] }}</td>
               </tr> 
            @endforeach                        
            </tbody>
            <tfoot>
                <tr>
                    <td colspan=3 class="text-right"><strong>VAT:</strong></td>
                    <td>0</td>
                </tr>
                <tr>
                    <td colspan=3 class="text-right"><strong>Delivery cost:</strong></td>
                    <td>0</td>
                </tr>
                <tr>
                    <td colspan=3 class="text-right"><strong>Grand total:</strong></td>
                    <td>{{ $basket->getTotal() }}</td>
                </tr>
            </tfoot>
        </table>
    @else
        <p>Your shopping basket is empty. Please add something in it first.</p>
    @endif
</div>
@endsection