@extends('layouts.app')
@section('title', __('lang.introduction_sheet'))

@section('page_title')
    @lang('lang.introduction_sheet')
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.introduction_sheet')</a></li>
@endsection


@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        {{-- ++++++++++++++++ Add Button ++++++++++++++++ --}}
        <div class="col-md-3  col-lg-3 d-flex">
            <div class="widgetbar">
                <a href="{{ route('introduction-sheet.create') }}" class="btn btn-primary pull-left" target="_blank">
                    <i class="ri-add-line align-middle mr-2"></i>
                    @lang('lang.add')</a>
            </div>
        </div> <br /><br />
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                <div class="card p-2 mb-2">
                    <div class="wrapper1">
                        <div class="div1"></div>
                    </div>
                    <div class="wrapper2">
                        <div class="div2 table-scroll-wrapper">
                            <!-- content goes here -->
                            <div style="min-width: 1200px;max-height: 70vh;min-height:60vh;overflow: auto">
                                <table id="datatable-buttons" class="table table-striped table-bordered"
                                    style="width: 100% !important">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>كود العربة</th>
                                            <th>نوع العملية</th>
                                            <th>العملية</th>
                                            <th>العيار</th>
                                            <th>باركود العربة</th>
                                            <th>@lang('lang.added_by')</th>
                                            <th>@lang('lang.updated_by')</th>
                                            <th>@lang('lang.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($introductionSheets as $index => $introductionSheet)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $introductionSheet->car_sku ?? '' }}</td>
                                                <td>{{ $introductionSheet->process_type }}</td>
                                                <td>{{ $introductionSheet->process }}</td>
                                                <td>{{ $introductionSheet->caliber }}</td>
                                                <td>
                                                    {!! DNS1D::getBarcodeHTML($introductionSheet->car_barcode, 'C39') !!}
                                                    {{ $introductionSheet->car_barcode }}
                                                </td>
                                                <td>
                                                    @if ($introductionSheet->created_by > 0 and $introductionSheet->created_by != null)
                                                        {{ $introductionSheet->created_at->diffForHumans() }} <br>
                                                        {{ $introductionSheet->created_at->format('Y-m-d') }}
                                                        ({{ $introductionSheet->created_at->format('h:i') }})
                                                        {{ $introductionSheet->created_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                        <br>
                                                        {{ $introductionSheet->createBy->name }}
                                                    @else
                                                        {{ __('lang.no') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($introductionSheet->edited_by > 0 and $introductionSheet->edited_by != null)
                                                        {{ $introductionSheet->updated_at->diffForHumans() }} <br>
                                                        {{ $introductionSheet->updated_at->format('Y-m-d') }}
                                                        ({{ $introductionSheet->updated_at->format('h:i') }})
                                                        {{ $introductionSheet->updated_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                        <br>
                                                        {{ $introductionSheet->updateBy?->name }}
                                                    @else
                                                        {{ __('lang.no') }}
                                                    @endif
                                                </td>
                                                {{-- ++++++++++++++++++++ Actions Dropdown ++++++++++++++++++++ --}}
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="btn btn-secondary dropdown-toggle" href="#"
                                                            role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            {{ __('lang.action') }}
                                                        </a>
                                                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                                            user="menu" x-placement="bottom-end"
                                                            style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            {{-- +++++++++++++ edit button +++++++++++++ --}}
                                                            <li>
                                                                <a href="{{ route('introduction-sheet.edit', $introductionSheet->id) }}"
                                                                    class="btn" target="_blank">
                                                                    <i class="fa fa-edit"></i>
                                                                    {{ __('lang.edit') }}
                                                                </a>
                                                            </li>
                                                            {{-- +++++++++++++ destroy button +++++++++++++ --}}
                                                            <li>
                                                                <a data-href="{{ route('introduction-sheet.destroy', $introductionSheet->id) }}"
                                                                    class="btn delete_item">
                                                                    <i class="fa fa-trash text-danger"></i>
                                                                    {{ __('lang.delete') }}
                                                                </a>
                                                            </li>
                                                            {{-- +++++++++++++ print button +++++++++++++ --}}
                                                            <li>
                                                                <a href="{{ route('print_invoice', $introductionSheet->id) }}"
                                                                    class="btn print-invoice" title="print sheet">
                                                                    <i class="dripicons-print"></i>
                                                                    {{ __('lang.print') }}
                                                                </a>
                                                            </li>
                                                            {{-- +++++++++++++ print button +++++++++++++ --}}
                                                            <li>
                                                                <a href="{{ route('print_barcode', $introductionSheet->id) }}"
                                                                    class="btn print-invoice" title="print barcode">
                                                                    <i class="fa fa-barcode" aria-hidden="true"></i>
                                                                    طباعة باركود
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="view_modal no-print">
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
{{-- @push('javascripts')

@endpush --}}
