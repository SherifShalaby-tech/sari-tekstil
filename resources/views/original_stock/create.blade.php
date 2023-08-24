@extends('layouts.app')
@section('title', __('lang.add_original_stock'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->                    
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">E-Commerce</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item"><a href="{{route('employees.index')}}">{{__('lang.original_stock')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.add_original_stock')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>          
    </div>
@endsection
@section('content')
<div class="contentbar">
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 col-xl-12">
            <div class="card m-b-30 p-2">
                <div class="container">
                    <livewire:add-original-stock />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection