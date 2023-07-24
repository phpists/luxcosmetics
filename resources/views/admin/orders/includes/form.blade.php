<div class="row">
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label>Тип доставки</label>
            <select class="form-control selectpicker" name="delivery_type" required>
                <option
                    value="{{ \App\Models\Order::DELIVERY_TYPE_STANDARD }}" @selected(old('delivery_type', $order->delivery_type == \App\Models\Order::DELIVERY_TYPE_STANDARD))>
                    Стандарт
                </option>
                <option
                    value="{{ \App\Models\Order::DELIVERY_TYPE_EXPRESS }}" @selected(old('delivery_type', $order->delivery_type == \App\Models\Order::DELIVERY_TYPE_EXPRESS))>
                    Экспресс
                </option>
            </select>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label>Привязать к пользователю</label>
            <select class="form-control select2" name="user_id" required>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" @selected(old('user_id', $order->user_id) == $user->id)>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="form-group">
            <label>Имя Фамилия</label>
            <input type="text" name="full_name" value="{{ old('full_name', $order->full_name) }}" class="form-control"
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
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="exampleSelect2">Регион</label>
            <input type="text" name="region" value="{{ old('region', $order->region) }}" class="form-control" required/>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="exampleSelect2">Город</label>
            <input type="text" name="city" value="{{ old('city', $order->city) }}" class="form-control" required/>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="exampleSelect2">Адрес</label>
            <input type="text" name="address" value="{{ old('address', $order->address) }}" class="form-control"
                   required/>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="form-group">
            <div class="checkbox-inline">
                <label class="checkbox">
                    <input type="checkbox" @checked(old('gift_box', $order->gift_box)) name="gift_box"/>
                    <span></span>
                    Подарочная коробка
                </label>
                <label class="checkbox">
                    <input type="checkbox"
                           @checked(old('as_delivery_address', $order->as_delivery_address)) name="as_delivery_address"/>
                    <span></span>
                    Использовать как адрес доставки
                </label>
            </div>
        </div>
    </div>
</div>
