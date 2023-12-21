<div class="row">
{{--    <div class="col-12 col-md-3">--}}
{{--        <div class="form-group">--}}
{{--            <label>Тип доставки</label>--}}
{{--            <select class="form-control selectpicker" name="delivery_type" required>--}}
{{--                <option--}}
{{--                    value="{{ \App\Models\Order::DELIVERY_TYPE_STANDARD }}" @selected(old('delivery_type', $order->delivery_type == \App\Models\Order::DELIVERY_TYPE_STANDARD))>--}}
{{--                    Стандарт--}}
{{--                </option>--}}
{{--                <option--}}
{{--                    value="{{ \App\Models\Order::DELIVERY_TYPE_EXPRESS }}" @selected(old('delivery_type', $order->delivery_type == \App\Models\Order::DELIVERY_TYPE_EXPRESS))>--}}
{{--                    Экспресс--}}
{{--                </option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label>Привязать к пользователю</label>
            <select class="form-control select2" name="user_id" required>
                <option></option>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" @selected(old('user_id', $order->user_id) == $user->id)>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label>Имя</label>
            <input type="text" name="first_name" value="{{ old('first_name', $order->first_name) }}" class="form-control"
                   required/>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label>Фамилия</label>
            <input type="text" name="last_name" value="{{ old('last_name', $order->last_name) }}" class="form-control"
                   required/>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label>Телефон</label>
            <input type="text" name="phone" value="{{ old('phone', $order->phone) }}" class="form-control" required/>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="exampleSelect2">E-mail</label>
            <input type="email" name="email" value="{{ old('email', $order->email) }}" class="form-control"
                   required/>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="exampleSelect2">Способ доставки</label>
            <select class="form-control select2" name="delivery_type" required>
                <option></option>
                @foreach(\App\Models\Order::ALL_DELIVERIES as $delivery_value => $delivery_title)
                    <option value="{{ $delivery_value }}" @selected(old('delivery_type', $order->delivery_type) == $delivery_value)>{{ $delivery_title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="exampleSelect2">Сервис</label>
            <select class="form-control select2" name="service">
                <option></option>
                @foreach(\App\Models\Order::ALL_DELIVERY_SERVICES as $service_name => $service_title)
                    <option value="{{ $service_name }}" @selected(old('service', $order->service) == $service_name)>{{ $service_title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="exampleSelect2">Город</label>
            <input type="text" name="city" value="{{ old('city', $order->city) }}" class="form-control"
                   required/>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="exampleSelect2">Улица</label>
            <input type="text" name="street" value="{{ old('street', $order->street) }}" class="form-control"
                   required/>
        </div>
    </div>
    <div class="col-12 col-md-1">
        <div class="form-group">
            <label for="exampleSelect2">Дом</label>
            <input type="text" name="house" value="{{ old('house', $order->house) }}" class="form-control"
                   required/>
        </div>
    </div>
    <div class="col-12 col-md-2">
        <div class="form-group">
            <label for="exampleSelect2">Индекс</label>
            <input type="text" name="zip" value="{{ old('zip', $order->zip) }}" class="form-control"
                   required/>
        </div>
    </div>
    <div class="col-12 col-md-1">
        <div class="form-group">
            <label for="exampleSelect2">Квартира/Офис</label>
            <input type="text" name="apartment" value="{{ old('apartment', $order->apartment) }}" class="form-control"/>
        </div>
    </div>
    <div class="col-12 col-md-1">
        <div class="form-group">
            <label for="exampleSelect2">Домофон</label>
            <input type="text" name="intercom" value="{{ old('intercom', $order->intercom) }}" class="form-control"/>
        </div>
    </div>
    <div class="col-12 col-md-1">
        <div class="form-group">
            <label for="exampleSelect2">Подъезд</label>
            <input type="text" name="entrance" value="{{ old('entrance', $order->entrance) }}" class="form-control"/>
        </div>
    </div>
    <div class="col-12 col-md-1">
        <div class="form-group">
            <label for="exampleSelect2">Этаж</label>
            <input type="text" name="over" value="{{ old('over', $order->over) }}" class="form-control"/>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label for="exampleSelect2">Способ оплаты</label>
            <select class="form-control select2" name="payment_type" required>
                <option></option>
                @foreach(\App\Models\Order::ALL_PAYMENTS as $payment_value => $payment_title)
                    <option value="{{ $payment_value }}" @selected(old('payment_type', $order->payment_type) == $payment_value)>{{ $payment_title }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>


<div class="row">
    <div id="bonusesContainer" class="col-12 col-md-2" @if(!$order->bonuses_discount) style="display:none;" @endif>
        <div class="form-group">
            <label>Бонусы: доступно - <b id="bonusesCount">{{ $order->user->points ?? 0 }}</b></label>
            <input type="number" name="bonuses_discount" value="{{ old('bonuses', $order->bonuses_discount) }}" class="form-control"/>
        </div>
    </div>
    <div class="col-12 col-md-auto">
        <div class="form-group mt-10">
            <div class="checkbox-inline">
                <label class="checkbox">
                    <input type="checkbox" @checked(old('gift_box', $order->gift_box)) name="gift_box"/>
                    <span></span>
                    Подарочная коробка
                </label>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-auto">
        <div class="form-group mt-10">
            <div class="checkbox-inline">
                <label class="checkbox">
                    <input type="checkbox" @checked(old('is_received_by_1c', $order->is_received_by_1c)) name="is_received_by_1c"/>
                    <span></span>
                    Передано в 1С
                </label>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-12 col-md-5">
        <div class="form-group">
            <label for="exampleSelect2">Примечание 1С</label>
            <textarea class="form-control" name="note" id="" cols="30" rows="10">{!! $order->note !!}</textarea>
        </div>
    </div>
</div>



<input type="hidden" id="showUserUrl" value="{{ route('admin.user.show', 0) }}">
