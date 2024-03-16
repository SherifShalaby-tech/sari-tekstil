@extends('layouts.app')
@section('title', __('lang.add_customers'))

@section('page_title')
    E-Commerce
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('customers.index') }}">{{ __('lang.customers') }}</a>
    </li>
    <li class="last active"><a href="#">@lang('lang.add_customers')</a></li>
@endsection
@push('css')
    <style>
        .form__label {
            top: 18px !important;
        }

        .form__field:focus+.form__label {
            top: -10px !important;
        }
    </style>
@endpush

@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                {!! Form::open([
                    'route' => 'customers.store',
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                <div class="card p-2 mb-2">
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-end px-4">
                            <div class="form__group">
                                {!! Form::text('name', null, [
                                    'class' => 'form__field required',
                                ]) !!}
                                {!! Form::label('name', __('lang.company_name'), ['class' => 'form__label']) !!}
                            </div>
                        </div>

                        <div class="col-md-3 px-4">
                            {!! Form::label('responsable_name', __('lang.responsable_name'), ['class' => 'form-label']) !!}
                            {!! Form::select('responsable_id', $users, null, [
                                'class' => 'form-control required',
                                'placeholder' => __('lang.please_select'),
                                'id' => 'brand_id',
                            ]) !!}
                        </div>
                        <div class="col-md-3 d-flex align-items-end px-4">
                            <div class="form__group">

                                {!! Form::text('country', null, [
                                    'class' => 'form__field required',
                                ]) !!}
                                {!! Form::label('country', __('lang.country'), ['class' => 'form__label']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-2 mb-2">
                    <div class="row">
                        <div class="col-md-3 mb-2 title">
                            <h4>@lang('lang.phone_numbers')</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-end px-4">
                            <div class="phones form__group">
                                <div class="d-flex">

                                    {!! Form::text('phones[]', null, [
                                        'class' => 'form__field',
                                        'placeholder' => __('lang.phone') . ' 1',
                                    ]) !!}
                                    {!! Form::label('phone', __('lang.phone'), ['class' => 'form__label']) !!}
                                    <button type="button" class="plus add_phone"><span class="inner"></span><i
                                            class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 d-flex align-items-end px-4">
                            <div class="emails form__group">
                                <div class="d-flex">

                                    {!! Form::email('emails[]', null, [
                                        'class' => 'form__field',
                                        'placeholder' => __('lang.email') . ' 1',
                                    ]) !!}
                                    {!! Form::label('email', __('lang.email'), ['class' => 'form__label']) !!}
                                    <button type="button" class="plus add_email">
                                        <span class="inner"></span><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" name="raw_phone_index" id="raw_phone_index" value="1">
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" name="raw_email_index" id="raw_email_index" value="1">
                        </div>
                    </div>
                </div>
                <div class="card p-2 mb-2">
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('company_address', __('lang.company_address'), ['class' => 'form-label']) !!}
                            {!! Form::textarea('company_address', null, [
                                'class' => 'form-control',
                                'rows' => '3',
                            ]) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('shipping_address', __('lang.shipping_address'), ['class' => 'form-label']) !!}
                            {!! Form::textarea('shipping_address', null, [
                                'class' => 'form-control',
                                'rows' => '3',
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="px-3 py-2 submit-button">
                        <span class="transition"></span>
                        <span class="gradient"></span>
                        <span class="label">@lang('lang.save')</span>
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->

    <!-- End Contentbar -->
@endsection
@push('javascripts')
    <script src="{{ asset('app-js/customer.js') }}"></script>
@endpush
