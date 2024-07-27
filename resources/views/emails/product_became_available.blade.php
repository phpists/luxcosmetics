<x-mail::message>
{!! $content !!}
<x-mail::button :url="route('products.product', ['alias' => $product->alias])">Перейти к товару</x-mail::button>
</x-mail::message>
