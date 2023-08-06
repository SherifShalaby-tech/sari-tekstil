@extends('layouts.app')
@section('title', __('lang.edit_suppliers'))
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
                                <li class="breadcrumb-item"><a href="{{route('suppliers.index')}}">{{__('lang.suppliers')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.edit_suppliers')</li>
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
                        'route' => ['suppliers.update',$supplier->id],
                        'method' => 'put',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('name', __('lang.company_name'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('name', $supplier->name, [
                                'class' => 'form-control required',
                            ]) !!}
                        </div>
                    
                        <div class="col-md-3">
                            {!! Form::label('responsable_name', __('lang.responsable_name'), ['class'=>'h6 pt-3']) !!}
                                {!! Form::select(
                                    'responsable_id',
                                    $users,$supplier->responsable_id,
                                    ['class' => 'form-control','placeholder'=>__('lang.please_select'),'id'=>'brand_id']
                            ) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('email', __('lang.email'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::email('email', $supplier->email, [
                                'class' => 'form-control required',
                            ]) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('country', __('lang.country'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('country', $supplier->country, [
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
                            {!! Form::label('phone', __('lang.phone')."#1", ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('phones[]', $supplier->phones[0], [
                                'class' => 'form-control required',
                            ]) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('phone', __('lang.phone')."#2", ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('phones[]', $supplier->phones[1], [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('phone', __('lang.phone')."#3", ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('phones[]', $supplier->phones[2], [
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pt-5">
                            <h4 class="phone-primary">@lang('lang.bank_acount_details')</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('bank_name', __('lang.bank_name'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('bank_name', $supplier->bank_name, [
                                'class' => 'form-control required',
                            ]) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('iban', __('lang.iban'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('iban', $supplier->iban, [
                                'class' => 'form-control required',
                            ]) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('currency', __('lang.currency'), ['class'=>'h6 pt-3']) !!}
                                {!! Form::select(
                                    'currency_id',
                                    $currencies,$supplier->currency_id,
                                    ['class' => 'form-control select2','placeholder'=>__('lang.please_select'),'id'=>'brand_id']
                            ) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('address', __('lang.address'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::textarea('address', $supplier->address, [
                                'class' => 'form-control required',
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