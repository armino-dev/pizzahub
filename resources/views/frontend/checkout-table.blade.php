<table class="table table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th scope="col">Price ({{ $currencySymbol }})</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $key => $item)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>
                {{ $item['name'] }}<br />Price: <span class="currency-symbol">{{ $currencySymbol }}</span> <span
                    id="price-{{$key}}">{{ number_format($item['price'] * $conversionRate, 2) }}</span>
                <form>
                    <button class="btn btn-outline-dark btn-minus-quantity mr-2" title="Decrease quantity"
                        aria-label="button" id={{ "btn-minus-quantity-".$key }} data-id={{ $key }}>
                        <i class="fas fa-minus-circle"></i>
                    </button>
                    <span id="quantity-{{$key}}"><strong>{{ $item['quantity'] }}</strong></span>
                    <button class="btn btn-outline-dark btn-plus-quantity ml-2" title="Increase quantity"
                        aria-label="button" id={{ "btn-plus-quantity-".$key }} data-id={{ $key }}>
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </form>
            </td>
            <td>
                <span
                    id="price-total-{{$key}}">{{ number_format($item['price'] * $item['quantity'] * $conversionRate, 2) }}</span>
                <br /><br />
                <button class="btn btn-danger btn-erase-item" title="Erase item from shopping basket"
                    aria-label="button" id={{ "btn-erase-item-".$key }} data-id={{ $key }}>
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" class="text-right"><strong>VAT {{config('settings.vat')}}%:</strong></td>
            <td>
                {{ $currencySymbol }}
                <span id="vat-cost">{{ number_format($basket->getTotal()*$conversionRate - $basket->getTotal()*$conversionRate/(1 + config('settings.vat')/100), 2) }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="text-right"><strong>Delivery cost:</strong></td>
            <td>
                {{ $currencySymbol }}
                <span id="delivery-cost">0</span>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="text-right"><strong>Grand total:</strong></td>
            <td>
                {{ $currencySymbol }}
                <span id="grand-total">{{ number_format($basket->getTotal()*$conversionRate, 2) }}</span>
            </td>
        </tr>
    </tfoot>
</table>