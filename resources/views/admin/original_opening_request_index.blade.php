@extends('layouts.app')
@section('title', __('lang.opening'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->                    
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">{{__('lang.opning_requests')}}</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.opening_requests')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="widgetbar">
                    <a href="{{route('admin_opening_request.create')}}" class="btn btn-primary"><i class="ri-add-line align-middle mr-2"></i>@lang('lang.add')</a>
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
                                <th>@lang('lang.source')</th>
                                <th>@lang('lang.type')</th>
                                <th>@lang('lang.requested_weight')</th>
                                <th>@lang('lang.shipment_number')</th>
                                <th>@lang('lang.batch_number')</th>
                                <th>@lang('lang.nationalities')</th>
                                <th>@lang('lang.percent')</th>
                                <th>@lang('lang.status')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($opiningRequests as $index=>$opiningRequest)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{$opiningRequest->source}}</td>
                                <td>{{$opiningRequest->type->name}}</td>
                                <td>{{$opiningRequest->requested_weight}}</td>
                                <td>{{$opiningRequest->shipment_number??"-"}}</td>
                                <td>{{$opiningRequest->batch_number??"-"}}</td>
                                <td>
                                    @foreach($opiningRequest->opening_request_nationalities as $opening_request_nationality)
                                        {{$opening_request_nationality->nationality->name}} <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($opiningRequest->opening_request_nationalities as $opening_request_nationality)
                                        {{$opening_request_nationality->percent}} %<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($opiningRequest->opening_request_nationalities as $opening_request_nationality)
                                        {{$opening_request_nationality->weight}} <br>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button fill="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">خيارات                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            
                                            <li>
                                                    <a data-href="{{route('admin_opening_request.destroy', $opiningRequest->id)}}"
                                                        class="btn text-red delete_item"><i class="fa fa-trash"></i>
                                                        @lang('lang.delete')</a>
                                            </li>
                                            
                                        </ul>
                                    </div>
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