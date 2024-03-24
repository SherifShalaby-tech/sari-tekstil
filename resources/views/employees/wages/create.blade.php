@extends('layouts.app')
@section('title', __('lang.add_wages'))

@section('page_title')
    @lang('lang.add_wages')
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('wages.index') }}">{{ __('lang.wages') }}</a>
    </li>
    <li class="last active"><a href="#">@lang('lang.add_wages')</a></li>
@endsection

@section('content')
    <div class="contentbar">
        <!-- Start row -->
        <div class="row ">
            <!-- Start col -->
            <div class="col-lg-12">
                {!! Form::open([
                    'route' => 'wages.store',
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                <div class="card p-2 mb-2  animate__animated animate__bounceInLeft" style="animation-delay: 1.5s">

                    <div class="row ">
                        <div class="col-md-3 mb-4 px-4">
                            {!! Form::label('employee_id', __('lang.name') . '*', [
                                'class' => 'form-label',
                            ]) !!}
                            {!! Form::select('employee_id', $employees, null, [
                                'class' => 'form-control select2',
                                'required',
                                'placeholder' => __('lang.please_select'),
                            ]) !!}
                            @error('employee_id')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-4 px-4">
                            {!! Form::label('payment_type', __('lang.payment_type') . '*', [
                                'class' => 'form-label',
                            ]) !!}
                            {!! Form::select('payment_type', $payment_types, null, [
                                'class' => 'form-control select2',
                                'required',
                                'placeholder' => __('lang.please_select'),
                            ]) !!}
                            @error('payment_type')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-4 d-flex align-items-end px-4">
                            <div class="form__group">
                                {!! Form::text('other_payment', null, [
                                    'class' => 'form__field',
                                ]) !!}
                                {!! Form::label('other_payment', __('lang.other_payment'), [
                                    'class' => 'form__label',
                                ]) !!}
                                @error('other_payment')
                                    <label class="text-danger error-msg">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 d-flex align-items-end px-4 account_period">
                            <div class="form__group">
                                {!! Form::text('acount_period_start_date', null, [
                                    'class' => 'form__field  datepicker calculate_salary',
                                    'placeholder' => __('lang.acount_period_start_date'),
                                    'id' => 'acount_period_start_date',
                                ]) !!}
                                <label class="form__label" for="acount_period_start_date">@lang('lang.acount_period_start_date')</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 d-flex align-items-end px-4 account_period">
                            <div class="form__group">
                                {!! Form::text('acount_period_end_date', null, [
                                    'class' => 'form__field datepicker calculate_salary',
                                    'placeholder' => __('lang.acount_period_end_date'),
                                    'id' => 'acount_period_end_date',
                                ]) !!}
                                <label class="form__label" for="acount_period_end_date">@lang('lang.acount_period_end_date')</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 d-flex align-items-end px-4">
                            <div class="form__group">
                                {!! Form::text('net_amount', null, [
                                    'class' => 'form__field',
                                    'placeholder' => __('lang.net_amount'),
                                    'id' => 'net_amount',
                                ]) !!}
                                <label class="form__label" for="net_amount">@lang('lang.net_amount')</label>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4 d-flex align-items-end px-4">
                            <div class="form__group">
                                {!! Form::text('deductibles', null, [
                                    'class' => 'form__field',
                                    'placeholder' => __('lang.deductibles'),
                                    'id' => 'deductibles',
                                ]) !!}
                                <label class="form__label" for="deductibles">@lang('lang.deductibles')</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 d-flex align-items-end px-4">
                            <div class="form__group">
                                {!! Form::text('reasons_of_deductibles', null, [
                                    'class' => 'form__field',
                                    'rows' => 3,
                                    'placeholder' => __('lang.reasons_of_deductibles'),
                                ]) !!}
                                <label class="form__label" for="reasons_of_deductibles">@lang('lang.reasons_of_deductibles')</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 px-4  account_period">

                            <label class="form-label" for="account_period">@lang('lang.account_period')</label>
                            {!! Form::month('account_period', null, [
                                'class' => 'form-control',
                                'placeholder' => __('lang.account_period'),
                                'id' => 'account_period',
                            ]) !!}
                        </div>




                        <input type="hidden" name="amount" id="amount">
                        <div class="col-md-3 mb-4 d-flex align-items-end px-4">
                            <div class="form__group">
                                {!! Form::text('payment_date', @format_date(date('Y-m-d')), [
                                    'class' => 'form__field datepicker',
                                    'placeholder' => __('lang.payment_date'),
                                ]) !!}
                                <label class="form__label" for="payment_date">@lang('lang.payment_date')</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4  px-4">

                            {!! Form::label('source_of_payment', __('lang.source_of_payment'), [
                                'class' => 'form-label',
                            ]) !!}
                            {!! Form::select('source_id', $users, null, [
                                'class' => 'select2 form-control',
                                'placeholder' => __('lang.please_select'),
                                'id' => 'source_id',
                                'required',
                            ]) !!}
                        </div>

                        <div class="col-md-3 mb-4 px-4">

                            {!! Form::label('source_type', __('lang.source_type'), [
                                'class' => 'form-label',
                            ]) !!}
                            {!! Form::select(
                                'source_type',
                                ['user' => __('lang.user'), 'pos' => __('lang.pos'), 'store' => __('lang.store'), 'safe' => __('lang.safe')],
                                null,
                                ['class' => 'select2 form-control', 'placeholder' => __('lang.please_select')],
                            ) !!}

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('notes', __('lang.notes'), ['class' => 'form-label']) !!}
                                {!! Form::textarea('notes', null, [
                                    'class' => 'form-control',
                                    'rows' => '3',
                                ]) !!}
                                @error('notes')
                                    <label class="text-danger error-msg">{{ $message }}</label>
                                @enderror
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

                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@push('javascripts')
    <script src="{{ asset('app-js/wage.js') }}"></script>
@endpush
