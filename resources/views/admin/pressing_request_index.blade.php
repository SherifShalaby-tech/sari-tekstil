@extends('layouts.app')
@section('title', __('lang.pressing'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->                    
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">{{__('lang.pressing_requests')}}</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.pressing_requests')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="widgetbar">
                    <a href="{{route('pressing-admin-requests.create')}}" class="btn btn-primary"><i class="ri-add-line align-middle mr-2"></i>@lang('lang.add')</a>
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
                                <th>@lang('lang.priority')</th>
                                <th>@lang('lang.filling')</th>
                                <th>@lang('lang.requested_weight')</th>
                                <th>@lang('lang.calibers')</th>
                                <th>@lang('lang.screening')</th>
                                <th>@lang('lang.destination')</th>
                                {{-- <th>@lang('lang.employee')</th> --}}
                                <th>@lang('lang.color')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pressing_request_transactions as $index=>$pressingRequestTransaction)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{$pressingRequestTransaction->source}}</td>
                                <td>{{$pressingRequestTransaction->priority}}</td>
                                <td>
                                    @foreach($pressingRequestTransaction->pressing_requests as $index=>$pressingRequest)
                                    {{$pressingRequest->filling->name??''}}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($pressingRequestTransaction->pressing_requests as $index=>$pressingRequest)
                                    {{$pressingRequest->weight}}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($pressingRequestTransaction->pressing_requests as $index=>$pressingRequest)
                                    @php
                                        $calibersString = implode(', ', $pressingRequest->calibers);
                                    @endphp
                                    {{ $calibersString }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($pressingRequestTransaction->pressing_requests as $index=>$pressingRequest)
                                        {{$pressingRequest->screening->name}}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($pressingRequestTransaction->pressing_requests as $index=>$pressingRequest)
                                    {{$pressingRequest->destination}}<br>
                                    @endforeach
                                </td>
                                {{-- <td>{{$fillingRequest->employee->name ??"-"}}</td> --}}
                                <td>
                                    @foreach($pressingRequestTransaction->pressing_requests as $index=>$pressingRequest)
                                    {{$pressingRequest->color->name ??"-"}}<br>
                                    @endforeach
                                </td>
                                {{-- @endforeach --}}
                                <td>
                                    <div class="btn-group">
                                        <button fill="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">خيارات                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            
                                            <li>
                                                    <a data-href="{{route('pressing-admin-requests.destroy', $pressingRequestTransaction->id)}}"
                                                        class="btn text-red delete_item"><i class="fa fa-trash"></i>
                                                        @lang('lang.delete')</a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="{{route('pressing-admin-requests.edit', $pressingRequestTransaction->id)}}" class="btn"><i class="dripicons-document-edit"></i> @lang('lang.update')</a>
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