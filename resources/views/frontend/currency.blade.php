<div 
    id="currency-switcher" 
    class="btn-group btn-group-sm" 
    role="group" 
    aria-label="Switch currency">
    <button 
        type="button" 
        data-currency="eur" 
        class="btn btn-secondary btn-sm {{ $currency === 'eur' ? 'active' : '' }}">EUR
    </button>
    <button 
        type="button" 
        data-currency="usd" 
        class="btn btn-secondary btn-sm {{ $currency === 'usd' ? 'active' : '' }}">USD
    </button>
</div>