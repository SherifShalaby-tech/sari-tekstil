@extends('layouts.app')
@section('title', 'عرض الانتاج')
@section('breadcrumbbar')
    <div class="breadcrumbbar">
        {{-- ///////// left side //////////// --}}
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">عرض الانتاج</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">@lang('lang.dashboard')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">عرض الانتاج</li>
                </ol>
            </div>
        </div>
    </div>
    {{-- +++++++++++++++ Style : checkboxes and labels inside selectbox +++++++++++++++ --}}
    <style>
        .selectBox {
        position: relative;
        }

        /* selectbox style */
        .selectBox select
        {
            width: 100%;
            padding: 0 !important;
            padding-left: 10px;
            padding-right: 10px;
            color: #fff;
            border: 1px solid #596fd7;
            background-color: #596fd7;
            height: 39px !important;
        }

        .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        }

        #checkboxes {
        display: none;
        border: 1px #dadada solid;
        height: 125px;
        overflow: auto;
        padding-top: 10px;
        /* text-align: end;  */
        }

        #checkboxes label {
        display: block;
        padding: 5px;

        }

        #checkboxes label:hover {
        background-color: #ddd;
        }
        #checkboxes label span
        {
            font-weight: normal;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{-- ////////////////////// Add Button ////////////////////// --}}
                    <div class="col-lg-12 mt-3">
                        <a href="{{ route('production.create') }}" class="btn btn-primary" id="production_create_btn">
                            اضافة انتاج
                            <i class="fa fa-plus"></i>
                        </a> <br/>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- ////////////////////// Filters ////////////////////// --}}
                            <div class="col-lg-12">
                                <div class="container-fluid">
                                    @include('production.partials.filters')
                                </div>
                            </div>
                            {{-- ++++++++++++++++++ Show/Hide Table Columns : selectbox of checkboxes ++++++++++++++++++ --}}
                            <div class="col-md-4 col-lg-4">
                                <div class="multiselect col-md-6">
                                    <div class="selectBox" onclick="showCheckboxes()">
                                        <select class="form-select">
                                            <option>@lang('lang.show_hide_columns')</option>
                                        </select>
                                        <div class="overSelect"></div>
                                    </div>
                                    <div id="checkboxes">
                                        {{-- +++++++++++++++++ checkbox1 : id +++++++++++++++++ --}}
                                        <label for="col1_id">
                                            <input type="checkbox" id="col1_id" name="col1" checked="checked" />
                                            <span>#</span> &nbsp;
                                        </label>
                                        {{-- +++++++++++++++++ checkbox2 : Checkboxes +++++++++++++++++ --}}
                                        <label for="col2_id">
                                            <input type="checkbox" id="col2_id" name="col2" checked="checked" />
                                            <span>Checkboxes</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox3 : رقم الشحنة +++++++++++++++++ --}}
                                        <label for="col3_id">
                                            <input type="checkbox" id="col3_id" name="col3" checked="checked" />
                                            <span>رقم الشحنة</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox4 : رقم التشغيل +++++++++++++++++ --}}
                                        <label for="col4_id">
                                            <input type="checkbox" id="col4_id" name="col4" checked="checked" />
                                            <span>رقم التشغيل</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox5 : الكود +++++++++++++++++ --}}
                                        <label for="col5_id">
                                            <input type="checkbox" id="col5_id" name="col5" checked="checked" />
                                            <span>الكود</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox6 : رقم الرابطة +++++++++++++++++ --}}
                                        <label for="col6_id">
                                            <input type="checkbox" id="col6_id" name="col6" checked="checked" />
                                            <span>رقم الرابطة</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox7 : نوع التعبئة +++++++++++++++++ --}}
                                        <label for="col7_id">
                                            <input type="checkbox" id="col7_id" name="col7" checked="checked" />
                                            <span>نوع التعبئة</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox8 : المكان الحالي +++++++++++++++++ --}}
                                        <label for="col8_id">
                                            <input type="checkbox" id="col8_id" name="col8" checked="checked" />
                                            <span>المكان الحالي</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox9 : weight +++++++++++++++++ --}}
                                        <label for="col9_id">
                                            <input type="checkbox" id="col9_id" name="col9" checked="checked" />
                                            <span>@lang('lang.weight')</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox10 : تاريخ الانتاج +++++++++++++++++ --}}
                                        <label for="col10_id">
                                            <input type="checkbox" id="col10_id" name="col10" checked="checked" />
                                            <span>تاريخ الانتاج</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox11 : اسم اخر عامل +++++++++++++++++ --}}
                                        <label for="col11_id">
                                            <input type="checkbox" id="col11_id" name="col11" checked="checked" />
                                            <span>اسم اخر عامل</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox12 : تكلفة الوحدة الواحدة +++++++++++++++++ --}}
                                        <label for="col12_id">
                                            <input type="checkbox" id="col12_id" name="col12" checked="checked" />
                                            <span>تكلفة الوحدة الواحدة</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox13 : المحتوي الاصلي +++++++++++++++++ --}}
                                        <label for="col13_id">
                                            <input type="checkbox" id="col13_id" name="col13" checked="checked" />
                                            <span>المحتوي الاصلي</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox14 : المحتوي الحالي +++++++++++++++++ --}}
                                        <label for="col14_id">
                                            <input type="checkbox" id="col14_id" name="col14" checked="checked" />
                                            <span>المحتوي الحالي</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox15 : العيار +++++++++++++++++ --}}
                                        <label for="col15_id">
                                            <input type="checkbox" id="col15_id" name="col15" checked="checked" />
                                            <span>العيار</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox16 : اللون +++++++++++++++++ --}}
                                        <label for="col16_id">
                                            <input type="checkbox" id="col16_id" name="col16" checked="checked" />
                                            <span>اللون</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox17 : الكمية +++++++++++++++++ --}}
                                        <label for="col17_id">
                                            <input type="checkbox" id="col17_id" name="col17" checked="checked" />
                                            <span>الكمية</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox18 : التكلفة الاجمالية +++++++++++++++++ --}}
                                        <label for="col18_id">
                                            <input type="checkbox" id="col18_id" name="col18" checked="checked" />
                                            <span>التكلفة الاجمالية</span>
                                        </label>
                                        {{-- +++++++++++++++++ checkbox19 : Action +++++++++++++++++ --}}
                                        <label for="col19_id">
                                            <input type="checkbox" id="col19_id" name="col19" checked="checked" />
                                            <span>{{ __('lang.action') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <br/><br/>
                            <div class="col-sm-12">
                                <form class="form-group" id="productForm" action="{{ route('production.invoice') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="table-responsive">
                                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="col1">#</th>
                                                        {{-- "select_all" checkbox --}}
                                                        <th class="col2"> <input type="checkbox" id="select_all_ids"/> </th>
                                                        <th class="col3">رقم الشحنة</th>
                                                        <th class="col4">رقم التشغيل</th>
                                                        <th class="col5">الكود</th>
                                                        <th class="col6">رقم الرابطة</th>
                                                        <th class="col7">نوع التعبئة</th>
                                                        <th class="col8">المكان الحالي</th>
                                                        <th class="col9">@lang('lang.weight')</th>
                                                        <th class="col10">تاريخ الانتاج</th>
                                                        <th class="col11">اسم اخر عامل</th>
                                                        <th class="col12">تكلفة الوحدة الواحدة</th>
                                                        <th class="col13">المحتوي الاصلي</th>
                                                        <th class="col14">المحتوي الحالي</th>
                                                        <th class="col15">العيار</th>
                                                        <th class="col16">اللون</th>
                                                        <th class="col17">الكمية</th>
                                                        <th class="col18">سعر البيع</th>
                                                        <th class="col19">المجموع الفرعي</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbody">
                                                    @foreach ($productions as $index => $production)
                                                        <tr>
                                                            <td class="col1">{{ $index + 1 }}</td>
                                                            <td class="col2">
                                                                <input type="checkbox" name="products[{{$index}}][checkbox]" class="checkbox_ids" value="1" />
                                                            </td>
                                                            <input type="hidden" class="form-control" name="products[{{$index}}][production_id]" value="{{ $production->id }}">
                                                            {{-- +++++++++++++++++ رقم الشحنة  +++++++++++++++++ --}}
                                                            <td class="col3" title="رقم الشحنة">
                                                                <input type="hidden" class="form-control" name="products[{{$index}}][delivery_number]" value="123">
                                                                {{ 123 }}
                                                            </td>
                                                            {{-- +++++++++++++++++ رقم التشغيل  +++++++++++++++++ --}}
                                                            <td class="col4" title="رقم التشغيل">
                                                                <input type="hidden" class="form-control" name="products[{{$index}}][operating_number]" value="123">
                                                                {{ 123 }}
                                                            </td>
                                                            {{-- +++++++++++++++++ الكود +++++++++++++++++ --}}
                                                            <td class="col5" title="الكود">
                                                                <input type="hidden" class="form-control" name="products[{{$index}}][sku]" value="{{ $production->sku }}">
                                                                {{ $production->sku ?? '' }}
                                                            </td>
                                                            {{-- +++++++++++++++++ رقم الرابطة  +++++++++++++++++ --}}
                                                            <td class="col6" title="رقم الرابطة">
                                                                <input type="hidden" class="form-control" name="products[{{$index}}][association_number]" value="1">
                                                                {{ 1 }}
                                                            </td>
                                                            {{-- +++++++++++++++++ نوع التعبئة +++++++++++++++++ --}}
                                                            <td class="col7" title="نوع التعبئة">
                                                                <input type="hidden" class="form-control" name="products[{{$index}}][packing_type]" value="{{ $production->packing_type }}">
                                                                {{$production->packing_type ?? '' }}
                                                            </td>
                                                            {{-- +++++++++++++++++ المكان الحالي +++++++++++++++++ --}}
                                                            <td class="col8" title="المكان الحالي">
                                                                <input type="hidden" class="form-control" name="products[{{$index}}][current_location]" value="{{ $production->current_location }}">
                                                                {{ $production->current_location }}
                                                            </td>
                                                            {{-- +++++++++++++++++ الوزن +++++++++++++++++ --}}
                                                            <td class="col9" title="@lang('lang.weight')">
                                                                <input type="hidden" class="form-control" name="products[{{$index}}][weight]" value="{{ $production->weight }}">
                                                                {{ $production->weight ?? '' }}
                                                            </td>
                                                            {{-- +++++++++++++++++ تاريخ الانتاج +++++++++++++++++ --}}
                                                            <td class="col10" title="تاريخ الانتاج">
                                                                <input type="hidden" class="form-control" name="products[{{$index}}][production_date]" value="{{ $production->production_date }}">
                                                                {{ $production->production_date ?? '' }}
                                                            </td>
                                                            {{-- +++++++++++++++++ اسم اخر عامل +++++++++++++++++ --}}
                                                            <td class="col11" title="اسم اخر عامل">
                                                                <input type="hidden" class="form-control" name="products[{{$index}}][last_worker]" value="{{ $production->last_worker }}">
                                                                {{ $production->last_worker }}
                                                            </td>
                                                            {{-- +++++++++++++++++ تكلفة الوحدة الواحدة	 +++++++++++++++++ --}}
                                                            <td class="col12" title="تكلفة الوحدة الواحدة">
                                                                <input type="hidden" class="form-control" name="products[{{$index}}][cost_per_unit]"  value="{{ $production->cost_per_unit }}">
                                                                {{ $production->cost_per_unit }}
                                                            </td>
                                                            {{-- +++++++++++++++++ المحتوي الاصلي +++++++++++++++++ --}}
                                                            <td class="col13" title="المحتوي الاصلي">
                                                                <input type="hidden" class="form-control" name="products[{{$index}}][original_content]"  value="{{ $production->original_content }}">
                                                                {{ $production->original_content }}
                                                            </td>
                                                            {{-- +++++++++++++++++ المحتوي الحالي +++++++++++++++++ --}}
                                                            <td class="col14" title="المحتوي الحالي">
                                                                <input type="hidden" class="form-control" name="products[{{$index}}][current_content]" value="{{ $production->current_content }}">
                                                                {{ $production->current_content ?? ''}}
                                                            </td>
                                                            {{-- +++++++++++++++++ العيار +++++++++++++++++ --}}
                                                            <td class="col15" title="العيار">
                                                                <input type="hidden" class="form-control" name="products[{{$index}}][caliber]" value="{{ $production->caliber }}">
                                                                {{ $production->caliber ?? '' }}
                                                            </td>
                                                            {{-- +++++++++++++++++ اللون +++++++++++++++++ --}}
                                                            <td class="col16"  title="اللون">
                                                                <input type="hidden" class="form-control" name="products[{{$index}}][color_id]" value="{{ $production->color_id }}">
                                                                {{ $production->color->name ?? '' }}
                                                            </td>
                                                            {{-- +++++++++++++++++ الكمية +++++++++++++++++ --}}
                                                            <td class="col17" title="الكمية">
                                                                <input type="text" class="form-control" id="quantity_id" name="products[{{$index}}][quantity]" value=" {{ $production->quantity }}">
                                                            </td>
                                                            {{-- +++++++++++++++++ سعر البيع +++++++++++++++++ --}}
                                                            <td class="col18" title="سعر البيع">
                                                                <input type="text" class="form-control" id="sell_price_id" name="products[{{$index}}][sell_price]" value="0">
                                                            </td>
                                                            {{-- +++++++++++++++++ التكلفة الاجمالية +++++++++++++++++ --}}
                                                            <td class="col19" title="التكلفة الاجمالية">
                                                                <input type="text" readonly class="form-control" id="total_cost_id" name="products[{{$index}}][total_cost]" value="0">
                                                            </td>
                                                            {{-- +++++++++++++++++ الخيارات: delete row button +++++++++++++++++ --}}
                                                            {{-- <td class="text-center col19" title="الخيارات">
                                                                <a href="javascript:void(0)" class="btn btn-xs btn-danger deleteRow">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </td> --}}
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <td colspan="16"></td>
                                                    <td colspan="2" class="text-center">الاجمالي</td>
                                                    <td class="sum_total_cost">
                                                        <input type="number" class="form-control" name="sum_total_cost" readonly id="sum_total_cost" value="0" />
                                                    </td>
                                                </tfoot>
                                            </table> <br/>

                                            {{-- +++++++++++++ save Button +++++++++++ --}}
                                            <div class="row pull-left">
                                                <div class="col-sm-12">
                                                    <div class="text-right">
                                                        <button type="submit" id="submit-btn" class="btn btn-primary" name="print">
                                                            انشاء فاتورة
                                                            <i class="fa fa-file-invoice"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div><br/><br/><br/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ++++++++++++++++++++++++++++++++++++++ Modal +++++++++++++++++++++++++++ --}}
        @include('production.partials.invoice_modal')

    </div>

@endsection

@push('javascripts')
    <script src="{{ asset('js/custom/custom_production/production_js.js') }}"></script>
    <script>


    </script>
@endpush
