@extends('layouts.app')
@section('title', __('lang.planning_carts'))
@section('breadcrumbbar')

@section('page_title')
    @lang('lang.planning_carts')
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('cars.index') }}">@lang('lang.cars')</a></li>
    <li class="last active"><a href="#">@lang('lang.planning_carts')</a></li>
@endsection

@section('content')

    <livewire:car-list />
@endsection
@push('javascripts')
    <script src="{{ asset('app-js/planning_carts.js') }}"></script>
@endpush
