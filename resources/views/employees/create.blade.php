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
                                'id'=>"inputmask-phone",
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
                            <input type="password" class="form-control" name="password" id="inputPassword" placeholder="{{__('lang.password')}}">
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('confirm_password', __('lang.confirm_password'), ['class'=>'h6 pt-3']) !!}
                            <input type="password" class="form-control" name="confirm_password" id="inputPassword" placeholder="{{__('lang.confirm_password')}}">
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('date_of_start_working', __('lang.date_of_start_working'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::date('date_of_start_working', null, [
                                'class' => 'form-control',
                                'placeholder'=>__('lang.date_of_start_working')
                            ]) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('date_of_birth', __('lang.date_of_birth'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::date('date_of_birth', null, [
                                'class' => 'form-control',
                                'placeholder'=>__('lang.date_of_birth')
                            ]) !!}
                        </div>

                        <div class="col-md-3">
                            {!! Form::label('upload_files', __('lang.upload_files'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::file('upload_files[]', null, [
                                'class' => 'form-control',
                                'multiple',
                                'placeholder'=>__('lang.upload_files')
                            ]) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('photo', __('lang.profile_photo'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::file('photo', null, [
                                'class' => 'form-control',
                                'placeholder'=>__('lang.profile_photo')
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