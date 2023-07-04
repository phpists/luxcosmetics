@extends('layouts.app')
@section('content')
    <section class="crumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ol class="crumbs__list">
                        <li class="crumbs__item"><a href="{{route('home')}}">Главная</a></li>
                        <li class="crumbs__item">Бренды</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="brands-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="title-h1">Бренды</h1>
                    <ul class="brands-page__letters  scroll">
                        <li class="brands-page__letter"><a href="">a</a></li>
                        <li class="brands-page__letter"><a href="">b</a></li>
                        <li class="brands-page__letter"><a href="">c</a></li>
                        <li class="brands-page__letter"><a href="">d</a></li>
                        <li class="brands-page__letter"><a href="">e</a></li>
                        <li class="brands-page__letter"><a href="">f</a></li>
                        <li class="brands-page__letter"><a href="">g</a></li>
                        <li class="brands-page__letter"><a href="">h</a></li>
                        <li class="brands-page__letter"><a href="">i</a></li>
                        <li class="brands-page__letter"><a href="">j</a></li>
                        <li class="brands-page__letter"><a href="">k</a></li>
                        <li class="brands-page__letter"><a href="">l</a></li>
                        <li class="brands-page__letter"><a href="">m</a></li>
                        <li class="brands-page__letter"><a href="">n</a></li>
                        <li class="brands-page__letter"><a href="">o</a></li>
                        <li class="brands-page__letter"><a href="">p</a></li>
                        <li class="brands-page__letter"><a href="">q</a></li>
                        <li class="brands-page__letter"><a href="">r</a></li>
                        <li class="brands-page__letter"><a href="">s</a></li>
                        <li class="brands-page__letter"><a href="">t</a></li>
                        <li class="brands-page__letter"><a href="">u</a></li>
                        <li class="brands-page__letter"><a href="">v</a></li>
                        <li class="brands-page__letter"><a href="">w</a></li>
                        <li class="brands-page__letter"><a href="">y</a></li>
                        <li class="brands-page__letter"><a href="">x</a></li>
                        <li class="brands-page__letter"><a href="">z</a></li>
                    </ul>
                    <form action="" class="brands-page__search form form--box">
                        <legend class="form__label">Найти бренд</legend>
                        <div class="brands-page__search-wrap">
                          <input type="text" class="form__input" id="brand-search-input">
                          <button class="btn btn--accent" id="brand-search-button">Искать</button>
                        </div>
                      </form>
                    @php
                        $letters = range('a', 'z');
                        $start_pos = 0;
                    @endphp
                    @foreach($letters as $letter)
                        @if($brands[$start_pos]->letter === $letter)
                            <div class="brands-page__item" id="{{$letter}}">
                                <div class="brands-page__title">{{$letter}}</div>
                                <div class="brands-page__brands">
                                    @for($idx=$start_pos;$idx < sizeof($brands); $idx++)
                                        @if($brands[$idx]->letter === $letter)
                                            <div class="brands-page__brand"><a href="{{ route('brands.show', ['link' => $brands[$idx]->link]) }}">{{$brands[$idx]->name}}</a></div>
                                        @else
                                            @php
                                                $start_pos = $idx;
                                            @endphp
                                            @break
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        @endif
                    @endforeach
                           
                </div>
            </div>
        </div>
</section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        {{-- Функціонал пошуку бренда по букві--}}
        <script>
            $(document).ready(function() {
            var selectedLetter = null;

            $('.brands-page__letter').click(function() {
                var currentLetter = $(this).text().trim().toLowerCase();

                if (selectedLetter === currentLetter) {
                    $('.brands-page__title, .brands-page__brand').show();
                    selectedLetter = null;
                    $('.brands-page__item').show();
                } else {
                    $('.brands-page__title, .brands-page__brand').hide();
                    $('#' + currentLetter).find('.brands-page__title, .brands-page__brand').show();
                    selectedLetter = currentLetter;
                    $('.brands-page__item').hide();
                    $('#' + currentLetter).show();
                }
                return false;
            });
            });
        </script>


        {{-- Функціонал форми пошуку бренда --}}
        <script>
        
            $(document).ready(function() {
        $('#brand-search-input').on('input', function() {
            var searchKeyword = $(this).val().trim().toLowerCase();
            $('.brands-page__brand').hide();
            $('.brands-page__item').hide();
            if (searchKeyword !== "") {
                $('.brands-page__brand').each(function() {
                    var brandName = $(this).text().toLowerCase();
                    if (brandName.includes(searchKeyword)) {
                        $(this).show();
                        var firstLetter = brandName.charAt(0);
                        $('.brands-page__title:contains("' + firstLetter + '")').parent().show();
                        $('.brands-page__title:contains("' + firstLetter + '")').show();
                    } else {
                    }
                });
            } else {
                $('div').removeClass('__active'); 
                $('.brands-page__item').show();
                $('.brands-page__brand, .brands-page__title').show();
            }
        });
    
        $('#brand-search-button').click(function(event) {
            event.preventDefault();
        });
    });
        </script>






@endsection

  
