@extends('layouts.app')
@section('title', 'Главная')
@section('content')

<br>
<a href="{{ route('home') }}"><button type="submit" class="btn btn-primary">Вийти</button></a>
<div class="container">
    <div class="align-items-center">
        <div class="d-flex justify-content-center">
            <div class="article__image">
                <a><img src="{{asset('images/uploads/news/' . $item->image)}}" alt="" style="width: 700px;"></a>
                    <div class="article__date">
                        <svg class="icon">
                            <use xlink:href="{{asset('images/dist/sprite.svg#calendar')}}"></use>
                        </svg>
                        {{ \Carbon\Carbon::parse($item->published_at)->locale('ru')->format('d.F.Y') }}
                    </div>
                    <div class="text-center">
                        <h2>{{ $item->title }}</h2>
                    </div>
                    <div>
                        <h3>{{ Str::limit(strip_tags($item->text)) }}</h3>
                    </div>
            </div>
        </div>
    </div>
            
</div>
</div>
</div>












@endsection
