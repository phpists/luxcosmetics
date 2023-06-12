@extends('layouts.app')
@section('title', 'Главная')
@section('content')

<br>
<div class="container">
    <div style="text-align: center;">
        <div>
            <h2>{{ $item->title }}</h2>
        </div>
        <div class="article__image">
            <a href=""><img src="{{asset('images/uploads/news/' . $item->image)}}" alt="" style="width: 700px; margin: 0 auto;"></a>
            <div class="article__date"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use></svg>{{$item->published_at}}</div>
        </div>
        <div>
            <div class="article__intro">
                <h3>{{ Str::limit(strip_tags($item->text), $limit = 30, $end = '...') }}</h3>
            </div>
        </div>
    </div>
    
</div>
@endsection
