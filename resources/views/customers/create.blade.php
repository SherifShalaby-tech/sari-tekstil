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




@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12 col-xl-12">
                <div class="card m-b-30 p-2">
                    {!! Form::open([
                        'route' => 'customers.store',
                        'method' => 'post',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('name', __('lang.company_name'), ['class' => 'h6 pt-3']) !!}
                            {!! Form::text('name', null, [
                                'class' => 'form-control required',
                            ]) !!}
                        </div>

                        <div class="col-md-3">
                            {!! Form::label('responsable_name', __('lang.responsable_name'), ['class' => 'h6 pt-3']) !!}
                            {!! Form::select('responsable_id', $users, null, [
                                'class' => 'form-control required',
                                'placeholder' => __('lang.please_select'),
                                'id' => 'brand_id',
                            ]) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('country', __('lang.country'), ['class' => 'h6 pt-3']) !!}
                            {!! Form::text('country', null, [
                                'class' => 'form-control required',
                            ]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pt-5">
                            <h4 class="text-primary">@lang('lang.phone_numbers')</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="phones">
                                {!! Form::label('phone', __('lang.phone'), ['class' => 'h6 pt-3']) !!}
                                <div class="d-flex justify-content-center">
                                    {!! Form::text('phones[]', null, [
                                        'class' => 'form-control',
                                        'placeholder' => __('lang.phone') . ' 1',
                                    ]) !!}
                                    <button type="button" class="btn btn-primary btn-sm ml-2 add_phone"><i
                                            class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" name="raw_phone_index" id="raw_phone_index" value="1">
                        </div>
                        <div class="col-md-4">
                            <div class="emails">
                                {!! Form::label('email', __('lang.email'), ['class' => 'h6 pt-3']) !!}
                                <div class="d-flex justify-content-center">
                                    {!! Form::email('emails[]', null, [
                                        'class' => 'form-control',
                                        'placeholder' => __('lang.email') . ' 1',
                                    ]) !!}
                                    <button type="button" class="btn btn-primary btn-sm ml-2 add_email"><i
                                            class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" name="raw_email_index" id="raw_email_index" value="1">
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-3">
                            {!! Form::label('company_address', __('lang.company_address'), ['class' => 'h6 pt-3']) !!}
                            {!! Form::textarea('company_address', null, [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('shipping_address', __('lang.shipping_address'), ['class' => 'h6 pt-3']) !!}
                            {!! Form::textarea('shipping_address', null, [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="col-md-3 pt-5">
                            <button type="submit" class="btn btn-primary ">@lang('lang.save')</button>
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
    <script src="{{ asset('app-js/customer.js') }}"></script>
@endpush
