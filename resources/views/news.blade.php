@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="title-h1">Новости</h1>
        <div class="row">
            @foreach (\App\Services\NewsService::getNews() as $item)
                <div class="col-4 article article--news">
                    <div class="article__image"><a href="{{ route('news.post', $item->link) }}"><img src="{{ $item->thumbnail_src }}" alt=""></a></div>
                    <div class="article__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg>{{ \Carbon\Carbon::parse($item->published_at)->locale('ru')->isoFormat('D.MMMM.YYYY') }}</div>
                    <div class="article__title"><a href="{{ route('news.post', $item->link) }}">{{ $item->title }}</a></div>
                    <div class="article__intro">{{ Str::limit(strip_tags($item->text), $limit = 90, $end = '...') }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
