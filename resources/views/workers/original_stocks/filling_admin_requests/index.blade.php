@extends('layouts.app')
@section('title', __('lang.filling_admin_requests'))

@section('page_title')
    {{ __('lang.filling_admin_requests') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.filling_admin_requests')</a></li>
@endsection


@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
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

                                            <th>@lang('lang.batch_number')</th>
                                            <th>@lang('lang.shipment_number')</th>
                                            <th>@lang('lang.requested_weight')</th>
                                            <th>@lang('lang.type')</th>
                                            <th>@lang('lang.status')</th>
                                            <th>@lang('lang.priority')</th>
                                            <th>@lang('lang.sku')</th>
                                            <th>@lang('lang.nationalities')</th>
                                            <th>@lang('lang.percent')</th>
                                            <th>@lang('lang.weight')</th>
                                            <th>@lang('lang.goods_weight')</th>
                                            <th>@lang('lang.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($openingrequests as $index => $request)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $request->batch_number }}</td>
                                                <td>{{ $request->shipment_number }}</td>
                                                <td>{{ @num_format($request->requested_weight) }}</td>
                                                <td>{{ $request->type->name }}</td>
                                                <td>
                                                    @if ($request->status == 'pendenig')
                                                        <span class="badge badge-primary">{{ $request->status }}</span>
                                                    @elseif($request->status == 'filled')
                                                        <span class="badge badge-danger">{{ $request->status }}</span>
                                                        {{-- @else --}}
                                                    @endif
                                                </td>
                                                <td>{{ $request->priority }}</td>
                                                <td>
                                                    @foreach ($request->opening_request_nationalities as $nationality)
                                                        @if ($nationality->car)
                                                            {{ $nationality->car->sku ?? '-' }}<br>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($request->opening_request_nationalities as $nationality)
                                                        {{ $nationality->nationality->name }}<br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($request->opening_request_nationalities as $nationality)
                                                        {{ $nationality->percentage }}<br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($request->opening_request_nationalities as $nationality)
                                                        {{ @num_format($nationality->weight) }}<br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($request->opening_request_nationalities as $nationality)
                                                        {{ @num_format($nationality->goods_weight) }}<br>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if (auth()->user()->can('orignal_store_worker'))
                                                        <a href="{{ route('filling-admin-requests.edit', $request->id) }}"
                                                            class="btn btn-primary"><i class="dripicons-document-edit"></i>
                                                            @lang('lang.update')</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End col -->
                    </div>
                    <!-- End row -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Contentbar -->
@endsection
