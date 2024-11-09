<div class="row">
    @if($properties?->isNotEmpty())
        @foreach($properties as $property)
            <div class="col-12 col-md-4 mb-5">
                <div class="input-group">
                    <input class="form-control select2" value="{{ $property->title }}" disabled/>
                    <input class="form-control select2" value="{{ $property->value }}" disabled/>
                    <div class="input-group-append">
                        <button class="btn btn-danger delete-property" data-url="{{ route('admin.promotion.properties.destroy', ['promotion' => $property->promotion, 'property' => $property]) }}" type="button"><i class="la la-trash-o pr-0"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
