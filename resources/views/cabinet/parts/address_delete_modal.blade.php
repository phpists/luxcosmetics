<div class="popupform mfp-hide" id="deleteAddress" style="max-width: 640px">
    <div class="popupform__title">Вы действительно хотите удалить адрес?</div>
    <div class="addprod">
        {{--        <div class="numbers addprod__numbers">--}}
        {{--            <div class="numbers__minus minus"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#minus')}}"></use></svg></div>--}}
        {{--            <input type="text" class="numbers__input" value="1">--}}
        {{--            <div class="numbers__plus plus"><svg class="icon"><use xlink:href="{{asset('images/dist/sprite.svg#plus')}}"></use></svg></div>--}}
        {{--        </div>--}}
    </div>
    <div class="popupform__btns">
        <button class="btn btn--border-main close">Закрыть</button>
        <form class="flex-fill" action="{{route('profile.addresses.delete')}}" method="POST">
            @csrf
            @method('delete')
            <input type="hidden" name="id" id="deleteId">
            <button class="btn btn--accent" style="width: 100%">Удалить</button>
        </form>
    </div>
</div>
