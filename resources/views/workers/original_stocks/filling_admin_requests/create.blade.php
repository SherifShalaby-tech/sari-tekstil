@extends('layouts.app')
@section('title', __('lang.filling_admin_requests'))

@section('page_title')
    @lang('lang.filling_admin_requests')
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('filling-admin-requests.index') }}">{{ __('lang.filling_admin_requests') }}</a>
    </li>
    <li class="last active"><a href="#">@lang('lang.filling_admin_requests')</a></li>
@endsection

@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                {!! Form::open([
                    'route' => ['filling-admin-requests.update', $opening_requests->id],
                    'method' => 'put',
                    'id' => 'car-update-form',
                ]) !!}
                @csrf
                @method('PUT')
                <div class="card p-2 mb-2  animate__animated animate__bounceInLeft" style="animation-delay: 1.5s">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <h5><span
                                    style="background-color: #116399;border-radius: 8px;color: white;padding: 7px;font-size: 14px;position: relative;;  z-index: 2;position: relative;">
                                    {{ __('lang.shipment_number') }} :
                                </span>
                                <span
                                    style="width: fit-content;padding: 5px 5px 5px 15px;min-width: 100px;display: inline-flex;margin-left: -5px;justify-content: center;background-color: #dedede;font-size: 14px;border-radius: 0 6px 6px 0;">
                                    {{ isset($opening_requests->shipment_number) ? $opening_requests->shipment_number : '-' }}
                                </span>
                            </h5>
                        </div>

                        <div class="col-md-4 mb-3">
                            <h5>
                                <span
                                    style="background-color: #116399;border-radius: 8px;color: white;padding: 7px;font-size: 14px;position: relative;">{{ __('lang.batch_number') }}
                                    :
                                </span>
                                <span
                                    style="width: fit-content;padding: 5px 5px 5px 15px;min-width: 100px;display: inline-flex;margin-left: -5px;justify-content: center;background-color: #dedede;font-size: 14px;border-radius: 0 6px 6px 0;">

                                    {{ isset($opening_requests->batch_number) ? $opening_requests->batch_number : '-' }}
                                </span>
                            </h5>
                        </div>

                        <div class="col-md-4 mb-3">
                            <h5><span
                                    style="background-color: #116399;border-radius: 8px;color: white;padding: 7px;font-size: 14px;position: relative;">{{ __('lang.date') }}
                                    :
                                </span>
                                <span
                                    style="width: fit-content;padding: 5px 5px 5px 15px;min-width: 100px;display: inline-flex;margin-left: -5px;justify-content: center;background-color: #dedede;font-size: 14px;border-radius: 0 6px 6px 0;">

                                    {{ isset($opening_requests->created_at) ? $opening_requests->created_at : '-' }}
                            </h5>
                            </span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <h5><span
                                    style="background-color: #116399;border-radius: 8px;color: white;padding: 7px;font-size: 14px;position: relative;">{{ __('lang.requested_weight') }}
                                    :
                                </span>
                                <span
                                    style="width: fit-content;padding: 5px 5px 5px 15px;min-width: 100px;display: inline-flex;margin-left: -5px;justify-content: center;background-color: #dedede;font-size: 14px;border-radius: 0 6px 6px 0;">
                                    {{ isset($opening_requests->requested_weight) ? @num_format($opening_requests->requested_weight) : 0 }}
                                </span>
                            </h5>
                        </div>

                        <div class="col-md-4 mb-3">
                            <h5>
                                <span
                                    style="background-color: #116399;border-radius: 8px;color: white;padding: 7px;font-size: 14px;position: relative;">{{ __('lang.type') }}
                                    :
                                </span>
                                <span
                                    style="width: fit-content;padding: 5px 5px 5px 15px;min-width: 100px;display: inline-flex;margin-left: -5px;justify-content: center;background-color: #dedede;font-size: 14px;border-radius: 0 6px 6px 0;">

                                    {{ isset($opening_requests->type_id) ? $opening_requests->type->name : 0 }}
                                </span>
                            </h5>
                        </div>

                        <div class="col-md-4 mb-3">
                            <h5>
                                <span
                                    style="background-color: #116399;border-radius: 8px;color: white;padding: 7px;font-size: 14px;position: relative;">{{ __('lang.priority') }}
                                    :
                                </span>
                                <span
                                    style="width: fit-content;padding: 5px 5px 5px 15px;min-width: 100px;display: inline-flex;margin-left: -5px;justify-content: center;background-color: #dedede;font-size: 14px;border-radius: 0 6px 6px 0;">
                                    {{ isset($opening_requests->priority) ? $opening_requests->priority : '-' }}
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-2 title">
                        <h4>@lang('lang.add_nationalities')</h4>
                    </div>
                </div>
                <div class="card p-2 mb-2  animate__animated animate__bounceInLeft" style="animation-delay: 1.5s">
                    <div class="nationalities">
                        @foreach ($opening_requests->opening_request_nationalities as $index => $nationality)
                            @include('workers.original_stocks.filling_admin_requests.add_nationalities')
                        @endforeach
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <button type="submit" class="px-3 py-2 submit-button">
                                <span class="transition"></span>
                                <span class="gradient"></span>
                                <span class="label">@lang('lang.save')</span>
                            </button>
                            <button type="button" class="px-3 py-2 print-button">
                                <span class="transition"></span>
                                <span class="gradient"></span>
                                <span class="label">@lang('lang.print')</span>
                            </button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
@push('javascripts')
    <script src="{{ asset('app-js/filling-admin-requests.js') }}"></script>
@endpush
