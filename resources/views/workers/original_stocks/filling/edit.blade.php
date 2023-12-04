@extends('layouts.app')
@section('title', __('lang.filling'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->                    
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">@lang('lang.filling')</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item"><a href="{{route('original-store-worker-filling.index')}}">{{__('lang.filling')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.filling')</li>
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
                    {!! Form::open(['route' => ['original-store-worker-filling.update',$fill->id],'method'=>'put' ]) !!}
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('type_id', __('lang.type')."*", ['class'=>'h6 pt-3']) !!}
                                {!! Form::select(
                                    'type_id',
                                    $types,$fill->type_id,
                                    ['class' => 'form-control selectpicker','data-live-search'=>"true",'required','placeholder'=>__('lang.please_select')]
                            ) !!}
                        </div>
                         <div class="col-md-3">
                            {!! Form::label('net_weight', __('lang.net_weight')."*", ['class'=>'h6 pt-3']) !!}
                            {!! Form::number('net_weight', $fill->net_weight, [
                                'class' => 'form-control net_weight',
                                'placeholder'=>'0.00','required'
                            ]) !!}
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            {!! Form::label('batch_number', __('lang.batch_number'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::number('batch_number', $fill->batch_number, [
                                'class' => 'form-control',
                                'placeholder'=>__('lang.batch_number')
                            ]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('sku', __('lang.sku')."*", ['class'=>'h6 pt-3']) !!}
                            {!! Form::select(
                                'sku',
                                $skus,$fill->car_id,
                                ['class' => 'form-control sku selectpicker','data-live-search'=>"true",'required','placeholder'=>__('lang.please_select')]
                            ) !!}
                        </div>
                        <div class="col-md-3">
                            {{-- {{$processes}}
                            {{$fill->process}} --}}
                            {!! Form::label('process', __('lang.table')."*", ['class'=>'h6 pt-3']) !!}
                                {!! Form::select(
                                    'process',
                                    $processes,$fill->process,
                                    ['class' => 'form-control selectpicker','data-live-search'=>"true",'required','placeholder'=>__('lang.please_select')]
                            ) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('workers', __('lang.employees')."*", ['class'=>'h6 pt-3']) !!}
                                {!! Form::select(
                                    'workers[]',
                                    $employees,$fill->workers,
                                    ['class' => 'form-control selectpicker','data-live-search'=>"true",'required','data-placeholder'=>__('lang.please_select'),'multiple']
                            ) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pt-5">
                            <h4 class="text-primary">@lang('lang.add_nationalities')</h4>
                        </div>
                    </div>
                    <div class="nationalities">
                        @php 
                         $hideBtn=2
                        @endphp
                         @if(!empty($fill->car_contents))
                            @foreach($fill->car_contents as $index=>$f_store)
                               
                                @include('workers.original_stocks.partials.add_nationalities',['f_store'=>$f_store,'index'=>$index,'hideBtn'=>$hideBtn])
                            @endforeach
                        @else
                            @include('workers.original_stocks.partials.add_nationalities')
                        @endif 
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-3 pt-5">
                            <button type="submit" class="btn btn-danger mr-3">@lang('lang.save')</button>
                            <button type="button" class="btn btn-primary print">@lang('lang.print')</button>
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
    <script src="{{ asset('app-js/original-store-worker.js') }}"></script>
@endpush