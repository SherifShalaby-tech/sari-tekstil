@extends('layouts.app')
@section('title', __('lang.store_worker_recieve_original'))

@section('page_title')
    {{ __('lang.store_worker_recieve_original') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.store_worker_recieve_original')</a></li>
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
