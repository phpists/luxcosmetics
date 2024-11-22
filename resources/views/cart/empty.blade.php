@extends('layouts.app')

@section('title', $metaTitle = getSeoTemplateTitle(\App\Enums\SeoTemplateEnum::CART))
@section('description', $metaDescription = getSeoTemplateDescription(\App\Enums\SeoTemplateEnum::CART))
@section('og:title', $metaTitle)
@section('og:description', $metaDescription)

@section('content')
<section class="cart-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 typography">
				<h1 class="title-h1">Корзина</h1>
				<p>Ваша корзина пуста, перейдите в каталог для выбора необходимого товара</p>
				<a href="{{ route('categories') }}" class="btn btn--accent">Каталог</a>
			</div>
		</div>
	</div>
</section>

@endsection
