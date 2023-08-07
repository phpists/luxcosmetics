@extends('layouts.app')

@section('content')
<section class="giftcardmain">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-6">
				<div class="giftcardmain__title">Подарочные карты</div>
				<div class="giftcardmain__subtitle">Подарите идеальный подарок</div>
				<div class="giftcardmain__btns">
					<a href="{{route('gif-card.create')}}" class="btn btn--border-main">Перейти в магазин</a>
					<a href="{{route('profile.gift-cards')}}" class="btn btn--accent">Проверить баланс карты</a>
				</div>
				<div class="giftcardmain__txt typography">Узнайте больше о подарочной карте <a href="">Нажмите здесь</a></div>
			</div>
		</div>
	</div>
</section>
@endsection
