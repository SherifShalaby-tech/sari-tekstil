@extends('layouts.app')
@section('title', __('lang.pressing'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">@lang('lang.pressing_request')</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item"><a href="{{route('pressing-admin-requests.index')}}">{{__('lang.pressing_request')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.pressing_request')</li>
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
                        'route' => 'pressing-admin-requests.store',
                        'method' => 'post',
                        'enctype' => 'multipart/form-data',
                    ]) !!}
                    <div class="row">


                        <div class="col-md-3">
                            {!! Form::label('type_id', __('lang.source')."*", ['class' => 'h6 pt-3']) !!}
                            {!! Form::select(
                                'source',
                                [
                                    'original' => 'Original',
                                    'other' => 'Other',
                                ],
                                null,
                                ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'required', 'placeholder' => __('lang.please_select')]
                            ) !!}
                        </div>

                        <div class="col-md-3">
                            {!! Form::label('customer', __('lang.customer')."*", ['class' => 'h6 pt-3']) !!}
                            {!! Form::select(
                                'customer_id',$customers,
                                null,
                                ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'required', 'placeholder' => __('lang.please_select')]
                            ) !!}
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 pt-5">

                        </div>
                    </div>
                    @php
                        $index = 1;
                    @endphp
                    <div class="fillings">
                        @include('admin.partials.add_pressing_row')
                    </div>
                    <input type="text" value="{{$index}}" class="row_index" hidden/>
                    <div class="row">
                        {{-- <div class="col-md-6 pt-5">
                            {!! Form::label('notes', __( 'lang.notes' )) !!}
                            {!! Form::text('notes', null, ['class' => 'form-control', 'placeholder' => __( 'lang.notes' ),
                            ]);
                            !!}
                        </div> --}}
                        <div class="col-md-2 pt-5">
                            {!! Form::label('priority', __( 'lang.priority' )) !!}
                            {!! Form::text('priority', null, ['class' => 'form-control', 'placeholder' => __( 'lang.priority' ),
                            ]);
                            !!}
                        </div>
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
<script src="{{ asset('app-js/pressing_request.js') }}"></script>
    {{-- <script>


    </script> --}}

@endpush
