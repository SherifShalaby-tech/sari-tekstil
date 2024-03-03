@extends('layouts.app')
@section('title', __('lang.filling_admin_requests'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-request"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">{{__('lang.filling_admin_requests')}}</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.filling_admin_requests')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbbar -->
@endsection
@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>

                                <th>@lang('lang.ids')</th>
                                <th>@lang('lang.source')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($fillingrequests as $index=>$request)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{$request->id}}</td>
                                <td>{{$request->source}}</td>
                                <td>
                                    @if(auth()->user()->can('orignal_store_worker'))
                                        <a href="{{route('filling-admin-requests.edit', $request->id)}}" class="btn btn-primary"><i class="dripicons-document-edit"></i> @lang('lang.update')</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
