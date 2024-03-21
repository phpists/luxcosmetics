@extends('layouts.app')

@section('title', $page->title ?? 'Ошибка')

@section('content')
<section class="crumbs">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ol class="crumbs__list">
					<li class="crumbs__item"><a href="">Главная</a></li>
					<li class="crumbs__item">Категория</li>
				</ol>
			</div>
		</div>
	</div>
</section>
<section class="cart-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 typography">
                @if($page)
                    {!! $page->content !!}
                @endif
			</div>
		</div>
	</div>
</section>

@endsection
