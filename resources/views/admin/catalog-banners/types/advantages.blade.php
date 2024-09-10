<div class="col-12">
    <div class="form-group w-100">
        <label for="advantagesColor" class=font-weight-bold">Цвет</label>
        <select name="data[color]" id="advantagesColor" class="form-control" required>
            @foreach(\App\Models\CatalogBanner::ALL_COLORS as $value => $title)
                <option value="{{ $value }}" @selected(isset($catalogBanner->data['color']) && $catalogBanner->data['color'] === $value)>{{ $title }}</option>
            @endforeach
        </select>
    </div>
    <div class="col px-0 advantagesRepeater">
        <label>Пункты:</label>
        <div class="form-group">
            <div data-repeater-list="data[items]">
                <div data-repeater-item class="form-group row mb-2">
                    <div class="col">
                        <input name="text" type="text" class="form-control"/>
                    </div>
                    <div class="col-auto">
                        <a href="javascript:;" data-repeater-delete=""
                           class="btn btn-sm font-weight-bolder btn-light-danger"><i class="la la-trash-o pr-0"></i></a>
                    </div>
                </div>
            </div>
            <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
                <i class="la la-plus"></i>Добавить
            </a>
        </div>
    </div>
</div>

<script>
    setInterval(() => {
        $($('#{{ $selector }} .advantagesRepeater:not(.initialized)')).each(function (i, el) {
            const repeater = $(el).repeater({
                initEmpty: false,
                isFirstItemUndeletable: true,
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            let items = $.parseJSON('@json($catalogBanner->data['items'] ?? [])');
            if (Array.isArray(items))
                repeater.setList(items)

            el.classList.add('initialized')
        })
    })
</script>
