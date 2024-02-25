@extends('layouts.app')
@section('title', __('lang.edit_customers'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">E-Commerce</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item"><a href="{{route('customers.index')}}">{{__('lang.customers')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.edit_customers')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                        'route' => ['customers.update',$customer->id],
                        'method' => 'put',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('name', __('lang.company_name'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('name', $customer->name, [
                                'class' => 'form-control required',
                            ]) !!}
                        </div>

                        <div class="col-md-3">
                            {!! Form::label('responsable_name', __('lang.responsable_name'), ['class'=>'h6 pt-3']) !!}
                                {!! Form::select(
                                    'responsable_id',
                                    $users,$customer->responsable_id,
                                    ['class' => 'form-control required','placeholder'=>__('lang.please_select'),'id'=>'brand_id']
                            ) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('country', __('lang.country'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('country', $customer->country, [
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
                            {!! Form::label('phone', __('lang.phone'), ['class'=>'h6 pt-3']) !!}
                            <div class="d-flex justify-content-center">
                                {!! Form::text('phones[]', $customer->phones[0], [
                                    'class' => 'form-control',
                                    'placeholder'=>__('lang.phone').' 1'
                                ]) !!}
                                <button type="button" class="btn btn-primary btn-sm ml-2 add_phone"><i class="fa fa-plus"></i></button>
                            </div>
                            @if ( count($customer['phones']) > 0 )
                                @for($i=1;$i<count($customer->phones);$i++)
                                    <div class="d-flex justify-content-center pt-2">
                                        {!! Form::text('phones[]', $customer->phones[$i], [
                                            'class' => 'form-control',
                                            'placeholder'=>__('lang.phone').' 1'
                                        ]) !!}
                                    </div>
                                @endfor
                            @endif
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" name="raw_phone_index" id="raw_phone_index" value="1">
                        </div>
                        <div class="col-md-4">
                            <div class="emails">
                            {!! Form::label('email', __('lang.email'), ['class'=>'h6 pt-3']) !!}
                            <div class="d-flex justify-content-center ">
                                {!! Form::email('emails[]',  $customer->emails[0], [
                                    'class' => 'form-control',
                                    'placeholder'=>__('lang.email').' 1'
                                ]) !!}
                                <button type="button" class="btn btn-primary btn-sm ml-2 add_email"><i class="fa fa-plus"></i></button>
                            </div>
                            @for($i=1;$i<count($customer->emails);$i++)
                                <div class="d-flex justify-content-center pt-2">
                                    {!! Form::text('emails[]', $customer->emails[$i], [
                                        'class' => 'form-control',
                                        'placeholder'=>__('lang.phone').' 1'
                                    ]) !!}
                                </div>
                            @endfor
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" name="raw_email_index" id="raw_email_index" value="1">
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-3">
                            {!! Form::label('company_address', __('lang.company_address'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::textarea('company_address', $customer->company_address, [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('shipping_address', __('lang.shipping_address'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::textarea('shipping_address', $customer->shipping_address, [
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
<script src="{{asset('app-js/customer.js')}}" ></script>
@endpush
