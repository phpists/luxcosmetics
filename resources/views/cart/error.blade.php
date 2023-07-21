@extends('layouts.app')

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
				<h1 class="title-h1">Произошла ошибка</h1>
				<p>В процессе заказа произошла ошибка. Попробуйте повторить попытку оплаты заказа в вашем личном кабинете, в разделе <a href="">Заказы</a></p>
				<a href="" class="btn btn--accent">Вернутся в  каталог</a>
			</div>
		</div>
	</div>
</section>

@endsection
