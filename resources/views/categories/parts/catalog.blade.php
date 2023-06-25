<div class="category-page__sortblock sortblock">
    <div class="sortblock__total">Показано <b>{{ $products->count() }} из {{ $products->total() }}</b></div>
    <div class="sortblock__sort sort">
        <span class="sort__title">Сортировать по</span>
        <select name="" id="select_sort_preview" class="sort__select">
            <option value="" @if(!request()->input('sort')) selected @endif>Стандарту</option>
            <option value="price:asc" @if(request()->input('sort') == 'price:asc') selected @endif>Возрастанию цены</option>
            <option value="price:desc" @if(request()->input('sort') == 'price:desc') selected @endif>Убыванию цены</option>
        </select>
    </div>
</div>
<div class="category-page__mobilenav">
    <button class="category-page__mobilebtn btnfilters"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#filters')}}"></use></svg> Показать фильтры</button>
    <button class="category-page__mobilebtn btnsort"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#arrows')}}"></use></svg> Сортировать по</button>
</div>
<div class="category-page__products">

    @include('categories.parts.products')

</div>
