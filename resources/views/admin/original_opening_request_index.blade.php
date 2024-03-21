@extends('layouts.app')
@section('title', __('lang.opening'))

@section('page_title')
    {{ __('lang.opening_requests') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.opening_requests')</a></li>
@endsection

@section('button')
    <a class="button" href="{{ route('admin_opening_request.create') }}">
        <div class="button-wrapper">
            <div class="text">@lang('lang.add')</div>
            <span class="icon">
                <i class="fas fa-plus text-white"></i>
            </span>
        </div>
    </a>
@endsection

@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">

            <!-- Start col -->
            <div class="col-lg-12">
                <div class="animate-in-page">
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
                                                <th>@lang('lang.source')</th>
                                                <th>@lang('lang.type')</th>
                                                <th>@lang('lang.requested_weight')</th>
                                                <th>@lang('lang.shipment_number')</th>
                                                <th>@lang('lang.batch_number')</th>
                                                <th>@lang('lang.nationalities')</th>
                                                <th>@lang('lang.percent')</th>
                                                <th>@lang('lang.status')</th>
                                                <th>@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($opiningRequests as $index => $opiningRequest)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $opiningRequest->source }}</td>
                                                    <td>{{ $opiningRequest->type->name }}</td>
                                                    <td>{{ $opiningRequest->requested_weight }}</td>
                                                    <td>{{ $opiningRequest->shipment_number ?? '-' }}</td>
                                                    <td>{{ $opiningRequest->batch_number ?? '-' }}</td>
                                                    <td>
                                                        @foreach ($opiningRequest->opening_request_nationalities as $opening_request_nationality)
                                                            {{ $opening_request_nationality->nationality->name }} <br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($opiningRequest->opening_request_nationalities as $opening_request_nationality)
                                                            {{ $opening_request_nationality->percent }} %<br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($opiningRequest->opening_request_nationalities as $opening_request_nationality)
                                                            {{ $opening_request_nationality->weight }} <br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        {{-- <div class="cd-dropdown-wrapper">

                                                        <a class="cd-dropdown-trigger" href="#0">خيارات</a>

                                                        <div class="cd-dropdown">
                                                            <ul class="cd-dropdown-content"> --}}
                                                        <div class=" cd-dropdown-wrapper">
                                                            <button fill="button"
                                                                class="cd-dropdown-trigger dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">خيارات
                                                                <span class="caret"></span>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul class="dropdown-menu cd-dropdown-content edit-options dropdown-menu-right dropdown-default"
                                                                user="menu" x-placement="bottom-end"
                                                                style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <li>
                                                                    <a data-href="{{ route('admin_opening_request.destroy', $opiningRequest->id) }}"
                                                                        class=" delete_item"><i class="fa fa-trash"></i>
                                                                        @lang('lang.delete')</a>
                                                                </li>
                                                                <li>
                                                                    <a
                                                                        href="{{ route('admin_opening_request.edit', $opiningRequest->id) }}"><i
                                                                            class="dripicons-document-edit"></i>
                                                                        @lang('lang.update')</a>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
