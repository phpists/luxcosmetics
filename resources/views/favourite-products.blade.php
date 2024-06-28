@extends('layouts.app')

@section('title', getSeoTemplateTitle(\App\Enums\SeoTemplateEnum::BOOKMARK))
@section('description', getSeoTemplateDescription(\App\Enums\SeoTemplateEnum::BOOKMARK))

@section('content')
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="crumbs__item">Избраное</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="category-page favorite-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-h1">Избранное</div>
                    <div class="category-page__container">

                        <main class="category-page__main">

                            @if($products)
                            <div class="category-page__sortblock sortblock">
                                <div class="sortblock__sort sort">
                                    <span class="sort__title">Выберите категорию </span>
                                    <select name="" id="" class="sort__select" onchange="location.href = '{{ route('favourites') }}/' + this.value">
                                        <option value="">Все товары</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @selected($categoryId == $category->id)>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="category-page__mobilenav">
                                <button class="category-page__mobilebtn btnsort">
                                    <svg class="icon">
                                        <use xlink:href="{{asset('images/dist/sprite.svg#arrows')}}"></use>
                                    </svg>
                                    Сортировать по
                                </button>
                            </div>
                            <div class="category-page__products">
                                @include('categories.parts.products', ['products' => $products, 'variations' => $variations, 'is_favourite_page' => true])
                            </div>
                            <div id="paginate">
                                @include('categories.parts.pagination')
                            </div>
                            @else
                                <p>Список избранного пуст, перейдите в каталог, чтоб добавить товары</p>
                                <a href="{{ route('categories') }}" class="btn btn--accent">Каталог</a>
                            @endif

                        </main>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="sortmobile">
        <div class="sortmobile__close">
            <svg class="icon">
                <use xlink:href="{{asset('images/dist/sprite.svg#close')}}"></use>
            </svg>
        </div>
        <div class="sortmobile__title">Выберите категорию</div>
        <label class="radio">
            <input type="radio" name="sort"/>
            <div class="radio__text">Уход за кожей</div>
        </label>
        <label class="radio">
            <input type="radio" name="sort"/>
            <div class="radio__text">Уход за телом</div>
        </label>
        <label class="radio">
            <input type="radio" name="sort"/>
            <div class="radio__text">Уход за волосами</div>
        </label>
    </div>
@endsection

@section('after_content')
    <div class="filters-overlay"></div>
    <div class="hidden">
        <!-- <form action="" class="form" id="callback">
            <h3>Оставить сообщение</h3>

            <input type="text"  name="Имя" placeholder="Ваше имя"  required="required">
            <input type="text"  name="Телефон" placeholder="Номер телефона" required="required">
            <input type="text"  name="E-mail" placeholder="E-mail" required="required">
            <textarea name="Сообщение" placeholder="Сообщение"></textarea>
            <button class="btn btn-feed">Отправить</button>
        </form> -->
        @include('layouts.includes.purchase_modal')
    </div>
    <div class="done-w">
        <div class="done-window">
            <div class="done-window__icn"></div>
            <div class="done-window__title">Ваша заявка принята</div>
            <div class="done-window__subtitle">Наш менеджер свяжется с Вами в течении 15 минут</div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            })

// Add to favourites
            function favouriteRemove() {
                let id = this.getAttribute('data-value');
                let heart = document.getElementById('header__linkcount');
                if (id !== null) {
                    $.ajax({
                        url: '/favourites',
                        method: 'DELETE',
                        data: {
                            id: id,
                            refresh: true
                        },
                        success: function (response) {
                            if (heart) {
                                if (response.count > 0) {
                                    heart.classList.remove('hidden');
                                    heart.innerText = response.count;
                                } else {
                                    heart.classList.add('hidden')
                                }
                            }
                            document.getElementById('paginate').innerHTML = response.paginateHtml;
                            document.querySelector('.category-page__products').innerHTML = response.productsHtml;
                            $('.product_favourite').on('click', favouriteRemove);
                        }
                    })
                }
            }
            $('.product_favourite').on('click', favouriteRemove);
            $('button.product__addcart').magnificPopup({
                items: {
                    src: '#addproduct',
                    type: 'inline'
                }
            });
        })

    </script>
@endsection
