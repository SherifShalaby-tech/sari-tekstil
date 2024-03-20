@extends('layouts.app')
@section('title', __('lang.add_original_stock'))


@section('page_title')
    Original stock
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('employees.index') }}">{{ __('lang.original_stock') }}</a></li>
    <li class="last active"><a href="#">@lang('lang.add_original_stock')</a></li>
@endsection
@push('css')
@endpush


@section('content')
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                <div class="card p-2 my-2">

                    <livewire:add-original-stock />

                </div>
            </div>
        </div>
    </div>
@endsection
