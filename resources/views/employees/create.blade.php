@extends('layouts.app')
@section('title', __('lang.add_employees'))
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
                                <li class="breadcrumb-item"><a href="{{route('employees.index')}}">{{__('lang.employees')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.add_employees')</li>
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
                        'route' => 'employees.store',
                        'method' => 'post',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    <div class="row">
                        {{--                     
                        <div class="col-md-3">
                            {!! Form::label('responsable_name', __('lang.responsable_name'), ['class'=>'h6 pt-3']) !!}
                                {!! Form::select(
                                    'responsable_id',
                                    $users,null,
                                    ['class' => 'form-control required','placeholder'=>__('lang.please_select'),'id'=>'brand_id']
                            ) !!}
                        </div> --}}
                        <div class="col-md-3">
                            {!! Form::label('name', __('lang.name'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('name', null, [
                                'class' => 'form-control required',
                            ]) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('email', __('lang.email'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::email('email', null, [
                                'class' => 'form-control required',
                            ]) !!}
                        </div>

                        <div class="col-md-3">
                            {!! Form::label('phone', __('lang.phone'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('phone', null, [
                                'class' => 'form-control',
                                'placeholder'=>__('lang.phone')
                            ]) !!}
                        </div>                       
                        <div class="col-md-3">
                            {!! Form::label('job_type', __('lang.job_type'), ['class'=>'h6 pt-3']) !!}
                                {!! Form::select(
                                    'job_type_id',
                                    $users,null,
                                    ['class' => 'form-control required','placeholder'=>__('lang.please_select'),'id'=>'brand_id']
                            ) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('password', __('lang.password'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('password', null, [
                                'class' => 'form-control',
                                'placeholder'=>__('lang.password')
                            ]) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('password', __('lang.confirm_password'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('confirm_password', null, [
                                'class' => 'form-control',
                                'placeholder'=>__('lang.confirm_password')
                            ]) !!}
                        </div>
                    </div>
                    <div class="row pt-4">
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
<script src="{{asset('app-js/employee.js')}}" ></script>
@endpush