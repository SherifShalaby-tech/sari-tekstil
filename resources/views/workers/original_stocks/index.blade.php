@extends('layouts.app')
@section('title', __('lang.store_worker_recieve_original'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">{{ __('lang.store_worker_recieve_original') }}</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('lang.dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.store_worker_recieve_original')</li>
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
        <livewire:original-stock-worker-list />
    </div>
    <!-- End Contentbar -->
@endsection
@push('javascripts')
    <script src="{{ asset('app-js/original-store-worker.js') }}"></script>
@endpush
