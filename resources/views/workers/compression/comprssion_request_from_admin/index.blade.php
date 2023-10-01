@extends('layouts.app')
@section('title', __('lang.compression_request_form_admin'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">{{ __('lang.compression_request_form_admin') }}</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('lang.dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.compression_request_form_admin')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Breadcrumbbar -->
@endsection
@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <livewire:compression-request-form-admin />
    </div>
    <!-- End Contentbar -->
@endsection
