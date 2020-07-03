@if(isset($categories))
<ul class="food-menu bg-dark">
    @foreach($categories as $category)
    <li class="item {{ Request::is(strtolower($category->name)) ? 'item-active' : '' }}">
        <a href="/{{ strtolower($category->name) }}" title={{$category->name}}>
            <span class="link-icon"><i class="{{ $category->icon }}"></i></span>
            <span class="link-text">{{ $category->name }}</span>
        </a>
    </li>
    @endforeach
</ul>
<div class="shopping-basket">

</div>
@endif