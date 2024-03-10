@extends('layouts.app')
@section('title', __('lang.compression_request_form_admin'))

@section('page_title')
    @lang('lang.compression_request_form_admin')
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.compression_request_form_admin')</a></li>
@endsection


@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <livewire:compression-request-form-admin />
    </div>
    <!-- End Contentbar -->
@endsection
