@extends('layouts.app')
@section('title', __('lang.add_suppliers'))

@section('page_title')
    E-Commerce
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('suppliers.index') }}">{{ __('lang.suppliers') }}</a>
    </li>
    <li class="last active"><a href="#">@lang('lang.add_suppliers')</a></li>
@endsection



@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                {!! Form::open([
                    'route' => 'suppliers.store',
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                <div class="card p-2 mb-2  animate__animated animate__bounceInLeft" style="animation-delay: 1.5s">
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
                                {!! Form::email('email', null, [
                                    'class' => 'form__field required',
                                ]) !!}
                                {!! Form::label('email', __('lang.email'), ['class' => 'form__label']) !!}
                            </div>
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
                <div class="card p-2 mb-2  animate__animated animate__bounceInLeft" style="animation-delay: 1.5s">
                    <div class="row">
                        <div class="col-md-3 mb-3 title">
                            <h4>@lang('lang.phone_numbers')</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-end px-4">
                            <div class="form__group">
                                {!! Form::text('phones[]', null, [
                                    'class' => 'form__field',
                                ]) !!}
                                {!! Form::label('phone', __('lang.phone') . '#1', ['class' => 'form__label']) !!}
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end px-4">
                            <div class="form__group">
                                {!! Form::text('phones[]', null, [
                                    'class' => 'form__field',
                                ]) !!}
                                {!! Form::label('phone', __('lang.phone') . '#2', ['class' => 'form__label']) !!}
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end px-4">
                            <div class="form__group">

                                {!! Form::text('phones[]', null, [
                                    'class' => 'form__field',
                                ]) !!}
                                {!! Form::label('phone', __('lang.phone') . '#3', ['class' => 'form__label']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-2 mb-2  animate__animated animate__bounceInLeft" style="animation-delay: 1.5s">
                    <div class="row">
                        <div class="col-md-3 mb-3 title">
                            <h4>@lang('lang.bank_acount_details')</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-end px-4">
                            <div class="form__group">
                                {!! Form::text('bank_name', null, [
                                    'class' => 'form__field required',
                                ]) !!}
                                {!! Form::label('bank_name', __('lang.bank_name'), ['class' => 'form__label']) !!}
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end px-4">
                            <div class="form__group">
                                {!! Form::text('iban', null, [
                                    'class' => 'form__field required',
                                ]) !!}
                                {!! Form::label('iban', __('lang.iban'), ['class' => 'form__label']) !!}
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            {!! Form::label('currency', __('lang.currency'), ['class' => 'form-label']) !!}
                            {!! Form::select('currency_id', $currencies, null, [
                                'class' => 'form-control select2',
                                'placeholder' => __('lang.please_select'),
                                'id' => 'brand_id',
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="card p-2 mb-2  animate__animated animate__bounceInLeft" style="animation-delay: 1.5s">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('address', __('lang.address'), ['class' => 'form-label']) !!}
                            {!! Form::textarea('address', null, [
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
