@extends('layouts.app')
@section('title', __('lang.transport_worker'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="media">
                    <div class="wrapper">
                        <div class="description">
                            <h3>{{ __('lang.transport_worker') }}</h3>
                            {{-- <p>Perfect for pages with long titles</p> --}}
                        </div>
                        <ul class="breadcrumbs">
                            <li class="first"><a href="{{ url('/') }}" class=""><i class="fas fa-home"></i></a>
                            </li>
                            <li class="last active"><a href="#">@lang('lang.transport_worker')</a></li>
                        </ul>
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
        <livewire:tranporter-items />
    </div>
    <!-- End Contentbar -->
@endsection
@push('javascripts')
    {{-- <script src="{{ asset('app-js/original-store-worker.js') }}"></script> --}}
@endpush
