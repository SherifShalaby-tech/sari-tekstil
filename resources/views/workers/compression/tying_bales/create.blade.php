@extends('layouts.app')
@section('title', __('lang.bales'))

@section('page_title')
    {{ __('lang.bales') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.bales')</a></li>
@endsection

@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <livewire:tying-bales />
    </div>
    <!-- End Contentbar -->
@endsection
