@extends('admin.layouts.app')
@section('title')
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <div class="d-flex align-items-center flex-wrap mr-1">
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <p class="text-muted">Редактированые подарочных карт</p>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            @include('admin.layouts.includes.messages')
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbar">
                        <ul class="nav nav-tabs nav-bold nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                                    <span class="nav-text">Редактирования</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel"
                             aria-labelledby="kt_tab_pane_1_4">
                            <input type="hidden" name="id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row align-items">
                                            <div class="w3-col colorthird1" style="text-align:center;">
                                                <h3>Цвет карты :</h3>
                                                <br>
                                                <form action="{{route('admin.storeColorCard')}}" method="post">
                                                    @csrf
                                                    <div style="margin:auto; width:236px;">
                                                        <div id="html5DIV">
                                                            <input type="color" name="color_card" id="html5colorpicker" onchange="clickColor(0, -1, -1, 5)" value="#ff0000" style="width:85%;">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <button class="btn btn-primary font-weight-bold createBtn">
                                                        <i class="fas fa-plus mr-2"></i>Добавить карту
                                                    </button>
                                                </form>
                                            </div>
                                            <div>
                                                <div class="card-body pb-3" style="max-width: 400px">
                                                    <div class="table-responsive">
                                                        <table id="networkTable" class="table table-head-custom table-vertical-center">
                                                            <thead>
                                                            <tr>
                                                                <th class="pl-0 text-center">
                                                                    Список карт
                                                                </th>

                                                                <th class="pr-0 text-right">
                                                                    Действия
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($items as $item)
                                                                @if ($item->color_card !== null)
                                                                    <tr>
                                                                    <td class="pl-0 text-center">
                                                                        <div class="giftcard-page__section">
                                                                            <div class="giftcard-page__cards">
                                                                                <label class="giftcardradio giftcard-page__card">
                                                                                    <input type="radio" name="color" value="{{ $item->color_card }}" required/>
                                                                                    <div class="giftcardradio__text" style="background-color: {{ $item->color_card }}"></div>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                        <td class="text-center">
                                                                            <form action="{{ route('admin.deleteColorCard', $item->id) }}" method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-sm btn-clean btn-icon" onclick="return confirm('Вы уверены, что хотите удалить это значения?')">
                                                                                    <i class="las la-trash"></i>
                                                                                </button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card card-custom" style="max-width: 400px">
                                                    <div class="card-header">
                                                        <div class="card-title">
                                                            <h3 class="card-label">
                                                                Редактирования чисел
                                                            </h3>
                                                        </div>
                                                        <div class="card-toolbar">
                                                            <button data-toggle="modal" data-target="#createModal"
                                                                    class="btn btn-primary font-weight-bold createBtn">
                                                                <i class="fas fa-plus mr-2"></i>Добавить
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body" >
                                                        <div class="table-responsive">
                                                            <table id="networkTable" class="table table-head-custom table-vertical-center">
                                                                <thead>
                                                                <tr>
                                                                    <th class="pl-0 text-center">
                                                                        №
                                                                    </th>
                                                                    <th class="pr-0 text-right">
                                                                        Действия
                                                                    </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($items as $item)
                                                                    <tr>
                                                                        <form action="{{ route('admin.updateFixPrice', $item->id) }}" method="post">
                                                                            <td class="handle text-center pl-0" style="cursor: pointer; max-width: 50px;">
                                                                                <input type="number" value="{{ $item->fix_price ?? '' }}" class="form-control" name="fix_price">
                                                                            </td>
                                                                            <td class="text-center">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                <button type="submit" class="btn btn-sm btn-clean btn-icon">
                                                                                    <i class="las la-edit"></i>
                                                                                </button>
                                                                            </td>
                                                                        </form>
                                                                        <form action="{{ route('admin.deleteFixPrice', $item->id) }}" method="post">
                                                                            <td class="text-center">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-sm btn-clean btn-icon" onclick="return confirm('Вы уверены, что хотите удалить это значения?')">
                                                                                    <i class="las la-trash"></i>
                                                                                </button>
                                                                            </td>
                                                                        </form>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="card-body" style="max-width: 300px;">
                                                    <form action="{{ route('admin.storeMinSum')}}" method="POST">
                                                        @csrf
                                                        <div class="form-group w-100">
                                                            <div class="row d-flex align-items">
                                                                <label for="createFaqPos" class="col-auto col-form-label font-weight-bold">Минимальная сумма для карты</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" value="{{$items[0]->min_sum ?? ''}}" class="form-control" name="min_sum" >
                                                                </div>
                                                                <button type="submit" class="btn btn-sm btn-clean btn-icon">
                                                                    <i class="las la-edit"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <form action="{{ route('admin.storeMaxSum')}}" method="POST">
                                                        @csrf
                                                        <div class="form-group w-100">
                                                            <div class="row d-flex align-items-center">
                                                                <label for="createFaqPos" class="col-auto col-form-label font-weight-bold">Максимальная сумма для карты</label>
                                                                <div class="col-sm-8">
                                                                    <input type="number" value="{{$items[0]->max_sum ?? ''}}" class="form-control" name="max_sum" >
                                                                </div>
                                                                <button type="submit" class="btn btn-sm btn-clean btn-icon">
                                                                    <i class="las la-edit"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<style>
    .giftcardradio input{
        position:absolute;
        z-index:-1;
        opacity:0
    }
    .giftcardradio__text{
        width:90px;
        height:60px
    }
</style>
@include('admin.gif-card.modals.create')
@endsection

@section('js_after')
    <script src="{{ asset('super_admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('super_admin/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <script src="{{ asset('super_admin/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }} "></script>

    <script>
        Promise.allSettled = Promise.allSettled || ((promises) => Promise.all(
            promises.map(p => p
                .then(value => ({
                    status: "fulfilled",
                    value
                }))
                .catch(reason => ({
                    status: "rejected",
                    reason
                }))
            )
        ));
    </script>
@endsection




