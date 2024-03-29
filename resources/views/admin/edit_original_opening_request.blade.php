@extends('layouts.app')
@section('title', __('lang.opening'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->                    
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">@lang('lang.opening_request')</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item"><a href="{{route('admin_opening_request.index')}}">{{__('lang.opening_request')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.opening_request')</li>
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
                    {!! Form::open(['route' => ['admin_opening_request.update',$opening_request->id],'method'=>'put','id'=>'opening_request-update-form' ]) !!}
                      @csrf
                      @method('PUT')
                    <div class="row">
                       
                    
                        <div class="col-md-3">
                            {!! Form::label('type_id', __('lang.type')."*", ['class'=>'h6 pt-3']) !!}
                                {!! Form::select(
                                    'type_id',
                                    $types,$opening_request->type_id,
                                    ['class' => 'form-control selectpicker','data-live-search'=>"true",'required','placeholder'=>__('lang.please_select')]
                            ) !!}
                        </div>
                         <div class="col-md-3">
                            {!! Form::label('requested_weight', __('lang.requested_weight')."*", ['class'=>'h6 pt-3']) !!}
                            {!! Form::number('requested_weight', $opening_request->requested_weight??0, [
                                'class' => 'form-control requested_weight',
                                'placeholder'=>'0.00','required'
                            ]) !!}
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">
                            {!! Form::label('batch_number', __('lang.batch_number'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('batch_number', $opening_request->batch_number??$batch_number, [
                                'class' => 'form-control',
                                'placeholder'=>__('lang.batch_number')
                            ]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pt-5">
                            <h4 class="text-primary">@lang('lang.add_nationalities')</h4>
                        </div>
                    </div>
                    <div class="nationalities">
                        @foreach($Opening_request_nationality as $index=>$Opening_request_nat)
                        @include('admin.partials.add_nationalities')
                        @endforeach
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

    <script src="{{ asset('app-js/opening_request.js') }}"></script>
    
        
@endpush