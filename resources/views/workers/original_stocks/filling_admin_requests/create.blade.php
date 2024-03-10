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
            <div class="col-lg-12 col-xl-12">
                <div class="card m-b-30 p-2">
                    {!! Form::open([
                        'route' => ['filling-admin-requests.update', $opening_requests->id],
                        'method' => 'put',
                        'id' => 'car-update-form',
                    ]) !!}
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-3">
                            <h5 class="pt-5">{{ __('lang.shipment_number') }} :
                                {{ isset($opening_requests->shipment_number) ? $opening_requests->shipment_number : '' }}
                            </h5>
                        </div>

                        <div class="col-md-3">
                            <h5 class="pt-5">{{ __('lang.batch_number') }} :
                                {{ isset($opening_requests->batch_number) ? $opening_requests->batch_number : '' }}</h5>
                        </div>
                        <div class="col-md-6"></div>

                        <div class="col-md-3">
                            <h5 class="pt-5">{{ __('lang.date') }} :
                                {{ isset($opening_requests->created_at) ? $opening_requests->created_at : '' }}</h5>
                        </div>
                        <div class="col-md-3">
                            <h5 class="pt-5">{{ __('lang.requested_weight') }} :
                                {{ isset($opening_requests->requested_weight) ? @num_format($opening_requests->requested_weight) : 0 }}
                            </h5>
                        </div>
                        <div class="col-md-3">
                            <h5 class="pt-5">{{ __('lang.type') }} :
                                {{ isset($opening_requests->type_id) ? $opening_requests->type->name : 0 }}</h5>
                        </div>

                        <div class="col-md-3">
                            <h5 class="pt-5">{{ __('lang.priority') }} :
                                {{ isset($opening_requests->priority) ? $opening_requests->priority : '' }}</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 pt-5">
                            <h4 class="text-primary">@lang('lang.add_nationalities')</h4>
                        </div>
                    </div>
                    <div class="nationalities">
                        @foreach ($opening_requests->opening_request_nationalities as $index => $nationality)
                            @include('workers.original_stocks.filling_admin_requests.add_nationalities')
                        @endforeach
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-3 pt-5">
                            <button type="submit" class="btn btn-danger mr-3">@lang('lang.save')</button>
                            <button type="button" class="btn btn-primary ">@lang('lang.print')</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
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
