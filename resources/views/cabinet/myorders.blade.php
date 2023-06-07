@extends('cabinet.layouts.cabinet')

@section('title', 'История заказов')

@section('page_content')
    <main class="cabinet-page__main">
        <table class="myorders">
            <thead>
            <tr>
                <th>Номер заказа</th>
                <th>Дата</th>
                <th>Статус</th>
                <th>Сумма</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td data-title="Номер заказа">2109/5</td>
                <td data-title="Дата">07.09.21</td>
                <td data-title="Статус"><span class="status status--new">Новый</span></td>
                <td data-title="Сумма">3 850 Р</td>
                <td><a href="">Подробнее</a></td>
            </tr>
            <tr>
                <td data-title="Номер заказа">1508/2</td>
                <td data-title="Дата">15.08.21</td>
                <td data-title="Статус"><span class="status status--cancel">Отменен</span></td>
                <td data-title="Сумма">48 650 Р</td>
                <td><a href="">Подробнее</a></td>
            </tr>
            <tr>
                <td data-title="Номер заказа">0208/45</td>
                <td data-title="Дата">02.08.20</td>
                <td data-title="Статус"><span class="status status--success">Выполнен</span></td>
                <td data-title="Сумма">34 880 Р</td>
                <td><a href="">Подробнее</a></td>
            </tr>
            <tr>
                <td data-title="Номер заказа">0208/45</td>
                <td data-title="Дата">02.08.20</td>
                <td data-title="Статус"><span class="status status--success">Выполнен</span></td>
                <td data-title="Сумма">34 880 Р</td>
                <td><a href="">Подробнее</a></td>
            </tr>
            <tr>
                <td data-title="Номер заказа">0208/45</td>
                <td data-title="Дата">02.08.20</td>
                <td data-title="Статус"><span class="status status--success">Выполнен</span></td>
                <td data-title="Сумма">34 880 Р</td>
                <td><a href="">Подробнее</a></td>
            </tr>
            <tr>
                <td data-title="Номер заказа">0208/45</td>
                <td data-title="Дата">02.08.20</td>
                <td data-title="Статус"><span class="status status--success">Выполнен</span></td>
                <td data-title="Сумма">34 880 Р</td>
                <td><a href="">Подробнее</a></td>
            </tr>
            <tr>
                <td data-title="Номер заказа">0208/45</td>
                <td data-title="Дата">02.08.20</td>
                <td data-title="Статус"><span class="status status--success">Выполнен</span></td>
                <td data-title="Сумма">34 880 Р</td>
                <td><a href="">Подробнее</a></td>
            </tr>
            </tbody>
        </table>
        <div class="pagination">
            <button class="pagination__more">Показать еще <span>12 товаров</span>
                <svg class="icon">
                    <use xlink:href="{{asset('images/dist/sprite.svg#refresh')}}"></use>
                </svg>
            </button>
            <ul class="pagination__list">
                <li class="pagination__item pagination__item--first"><a href="">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#first')}}"></use>
                        </svg>
                    </a></li>
                <li class="pagination__item pagination__item--prev"><a href="">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#prev1')}}"></use>
                        </svg>
                    </a></li>
                <li class="pagination__item pagination__item--active"><span>1</span></li>
                <li class="pagination__item"><a href="">2</a></li>
                <li class="pagination__item"><a href="">3</a></li>
                <li class="pagination__item pagination__item--dots">...</li>
                <li class="pagination__item"><a href="">36</a></li>
                <li class="pagination__item pagination__item--next"><a href="">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#next1')}}"></use>
                        </svg>
                    </a></li>
                <li class="pagination__item pagination__item--last"><a href="">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#last')}}"></use>
                        </svg>
                    </a></li>
            </ul>
        </div>
    </main>
@endsection
