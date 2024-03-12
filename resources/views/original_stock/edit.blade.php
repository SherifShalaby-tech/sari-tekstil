@extends('layouts.app')
@section('title', __('lang.add_original_stock'))






@section('page_title')
    Original stock
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('employees.index') }}">{{ __('lang.original_stock') }}</a></li>
    <li class="last active"><a href="#">{{ __('lang.edit_original_stock') }}</a></li>
@endsection


@section('content')
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12 col-xl-12">
                <div class="card m-b-30 p-2">
                    <div class="container">
                        <livewire:edit-original-stock />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
