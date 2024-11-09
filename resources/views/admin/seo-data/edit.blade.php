<form id="editSeoDataForm" action="{{ route('admin.seo-data.update', $seoData) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>Meta: Title</label>
                <input type="text" name="data[meta][title]" class="form-control" value="{{ $seoData->getMeta('title') }}">
            </div>
            <div class="form-group">
                <label>Meta: Description</label>
                <textarea class="form-control" id="" name="data[meta][description]">{{ $seoData->getMeta('description') }}</textarea>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label>OG: Title</label>
                <input type="text" name="data[og][title]" class="form-control" value="{{ $seoData->getOG('title') }}">
            </div>
            <div class="form-group">
                <label>OG: Description</label>
                <textarea class="form-control" id="" name="data[og][description]">{{ $seoData->getOG('description') }}</textarea>
            </div>
        </div>
    </div>
</form>
