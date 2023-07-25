<div class="tab-content mt-5" id="myTabContent">
    <input type="hidden" id="filterUrl" data-url="{{ route('admin.chats') }}">
    <form id="chats_form">
        <table class="table table-hover rounded ">
            <div class="row mb-2">
                <div class="col-lg-3 mb-lg-0 d-flex flex-column">
                    <label>Причина Обращения</label>
                    <div class="input-group input-group-sm">
                        <select id="feedbacks_reason_id" name="feedbacks_reason_id" class="form-control">
                            <option></option>
                           @foreach($themes as $theme)
                                <option value="{{$theme->id}}">{{$theme->reason}}</option>
                           @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 mb-lg-0 d-flex flex-column">
                    <label>Статус</label>
                    <div class="input-group input-group-sm">
                        <select class="form-control status" name="status">
                            <option></option>
                            <option value="{{\App\Models\FeedbackChat::NEW}}">{{\App\Services\SiteService::getChatStatus(\App\Models\FeedbackChat::NEW)}}</option>
                            <option value="{{\App\Models\FeedbackChat::VIEWED}}">{{\App\Services\SiteService::getChatStatus(\App\Models\FeedbackChat::VIEWED)}}</option>
                            <option value="{{\App\Models\FeedbackChat::CLOSED}}">{{\App\Services\SiteService::getChatStatus(\App\Models\FeedbackChat::CLOSED)}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </table>
    </form>
</div>


