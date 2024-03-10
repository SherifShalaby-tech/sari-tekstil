@extends('layouts.app')
@section('title', __('lang.recieve_shipment_from_supplier'))

@section('page_title')
    {{ __('lang.recieve_shipment_from_supplier') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.recieve_shipment_from_supplier')</a></li>
@endsection




@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <livewire:recieve-shipments-from-supplier />
    </div>
    <!-- End Contentbar -->
@endsection
@push('javascripts')
    <script src="{{ asset('app-js/original-store-worker.js') }}"></script>
@endpush
