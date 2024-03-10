@extends('layouts.app')
@section('title', __('lang.automatic_squeeze'))

@section('page_title')
    @lang('lang.automatic_squeeze')
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.automatic_squeeze')</a></li>
@endsection

@section('content')

    <livewire:squeeze-request />
@endsection
@push('javascripts')
    {{-- <script src="{{asset('app-js/planning_carts.js')}}" ></script> --}}
@endpush
