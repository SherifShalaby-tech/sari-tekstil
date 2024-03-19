@extends('layouts.app')
@section('title', __('lang.transport_worker'))

@section('page_title')
    {{ __('lang.transport_worker') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.transport_worker')</a></li>
@endsection

@section('content')
    <!-- Start Contentbar -->
    <div class="animate-in-page">
        <div class="contentbar">
            <livewire:tranporter-items />
        </div>
    </div>
    <!-- End Contentbar -->
@endsection
@push('javascripts')
    {{-- <script src="{{ asset('app-js/original-store-worker.js') }}"></script> --}}
@endpush
