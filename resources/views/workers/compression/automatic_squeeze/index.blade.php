@extends('layouts.app')
@section('title', __('lang.automatic_squeeze'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->                    
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-9 col-lg-9">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">@lang('lang.automatic_squeeze')</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                {{-- <li class="breadcrumb-item"><a href="{{route('cars.index')}}">{{__('lang.cars')}}</a></li> --}}
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.automatic_squeeze')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>          
    </div>
@endsection
@section('content')
   
<livewire:squeeze-request />
@endsection
@push('javascripts')
{{-- <script src="{{asset('app-js/planning_carts.js')}}" ></script> --}}
@endpush