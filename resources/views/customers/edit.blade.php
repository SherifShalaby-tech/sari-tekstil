@extends('layouts.app')
@section('title', __('lang.edit_customers'))

@section('page_title')
    E-Commerce
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('pressing-admin-requests.index') }}">{{ __('lang.customers') }}</a>
    </li>
    <li class="last active"><a href="#">@lang('lang.edit_customers')</a></li>
@endsection


@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                {!! Form::open([
                    'route' => ['customers.update', $customer->id],
                    'method' => 'put',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                <div class="card p-2 mb-2  animate__animated animate__bounceInLeft" style="animation-delay: 1.5s">
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-end px-4">
                            <div class="form__group">
                                {!! Form::text('name', $customer->name, [
                                    'class' => 'form__field required',
                                ]) !!}
                                {!! Form::label('name', __('lang.company_name'), ['class' => 'form__label']) !!}
                            </div>
                        </div>

                        <div class="col-md-3 px-4">
                            {!! Form::label('responsable_name', __('lang.responsable_name'), ['class' => 'form-label']) !!}
                            {!! Form::select('responsable_id', $users, $customer->responsable_id, [
                                'class' => 'form-control required',
                                'placeholder' => __('lang.please_select'),
                                'id' => 'brand_id',
                            ]) !!}
                        </div>
                        <div class="col-md-3 d-flex align-items-end px-4">
                            <div class="form__group">

                                {!! Form::text('country', $customer->country, [
                                    'class' => 'form__field required',
                                ]) !!}
                                {!! Form::label('country', __('lang.country'), ['class' => 'form__label']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-2 mb-2  animate__animated animate__bounceInLeft" style="animation-delay: 1.5s">
                    <div class="row">
                        <div class="col-md-3 mb-2 title">
                            <h4>@lang('lang.phone_numbers')</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex align-items-end px-4">
                            <div class="phones form__group">
                                <div class="d-flex">

                                    {!! Form::text('phones[]', $customer->phones[0], [
                                        'class' => 'form__field',
                                        'placeholder' => __('lang.phone') . ' 1',
                                    ]) !!}
                                    {!! Form::label('phone', __('lang.phone'), ['class' => 'form__label']) !!}
                                    <button type="button" class="plus add_phone"><span class="inner"></span><i
                                            class="fa fa-plus"></i></button>
                                </div>
                                @if (count($customer['phones']) > 0)
                                    @for ($i = 1; $i < count($customer->phones); $i++)
                                        <div class="d-flex justify-content-center">
                                            {!! Form::text('phones[]', $customer->phones[$i], [
                                                'class' => 'form__field',
                                                'placeholder' => __('lang.phone') . ' 1',
                                            ]) !!}
                                        </div>
                                    @endfor
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3 d-flex align-items-end px-4">
                            <div class="emails form__group">
                                <div class="d-flex">

                                    {!! Form::email('emails[]', $customer->emails[0], [
                                        'class' => 'form__field',
                                        'placeholder' => __('lang.email') . ' 1',
                                    ]) !!}
                                    {!! Form::label('email', __('lang.email'), ['class' => 'form__label']) !!}
                                    <button type="button" class="plus add_email"> <span class="inner"></span><i
                                            class="fa fa-plus"></i></button>
                                </div>
                                @for ($i = 1; $i < count($customer->emails); $i++)
                                    <div class="d-flex justify-content-center">
                                        {!! Form::text('emails[]', $customer->emails[$i], [
                                            'class' => 'form__field',
                                            'placeholder' => __('lang.phone') . ' 1',
                                        ]) !!}
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" name="raw_email_index" id="raw_email_index" value="1">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="hidden" name="raw_phone_index" id="raw_phone_index" value="1">
                    </div>
                    <div class="card p-2 mb-2  animate__animated animate__bounceInLeft" style="animation-delay: 1.5s">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('company_address', __('lang.company_address'), ['class' => 'form-label']) !!}
                                {!! Form::textarea('company_address', $customer->company_address, [
                                    'class' => 'form-control',
                                    'rows' => '3',
                                ]) !!}
                            </div>
                            <div class="col-md-3">
                                {!! Form::label('shipping_address', __('lang.shipping_address'), ['class' => 'form-label']) !!}
                                {!! Form::textarea('shipping_address', $customer->shipping_address, [
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
        </div>
    </div>
    <!-- End col -->

    <!-- End Contentbar -->
@endsection
@push('javascripts')
    <script src="{{ asset('app-js/customer.js') }}"></script>
@endpush
