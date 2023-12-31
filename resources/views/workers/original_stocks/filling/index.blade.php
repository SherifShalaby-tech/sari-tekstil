@extends('layouts.app')
@section('title', __('lang.filling'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->                    
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">{{__('lang.filling')}}</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.filling')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                @if(auth()->user()->can('orignal_store_worker'))
                <div class="widgetbar">
                    <a href="{{route('original-store-worker-filling.create')}}" class="btn btn-primary"><i class="ri-add-line align-middle mr-2"></i>@lang('lang.add')</a>
                </div>    
                @endif                    
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
                                <th>@lang('lang.sku')</th>
                                <th>@lang('lang.type')</th>
                                <th>@lang('lang.net_weight')</th>
                                <th>@lang('lang.batch_number')</th>
                                <th>@lang('lang.process')</th>
                                <th>@lang('lang.workers')</th>
                                <th>@lang('lang.nationalities')</th>
                                <th>@lang('lang.percent')</th>
                                <th>@lang('lang.actual_weight')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($fillings as $index=>$fill)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{$fill->car->sku}}</td>
                                <td>{{$fill->type->name}}</td>
                                <td>{{$fill->net_weight}}</td>
                                <td>{{$fill->car->batch_number??"-"}}</td>
                                <td>{{$fill->process}}</td>
                                <td>
                                    @if(!empty($fill->workers))
                                        @for($i=0;$i<count($fill->workers);$i++)
                                            {{\App\Models\Employee::find($fill->workers[$i])->name}}<br>
                                        @endfor
                                    @endif
                                </td>
                                <td>
                                    @foreach($fill->car_contents as $content)
                                        {{$content->nationality->name}} <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($fill->car_contents as $content)
                                        {{$content->percentage ??0}} % <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($fill->car_contents as $content)
                                        {{$content->goods_weight ??0}} <br>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button fill="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">خيارات                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            @if(auth()->user()->can('orignal_store_worker'))
                                            <li>
                                                <a href="{{route('original-store-worker-filling.edit', $fill->id)}}" class="btn"><i class="dripicons-document-edit"></i> @lang('lang.update')</a>
                                            </li>
                                            @endif
                                            <li class="divider"></li>
                                            @if(auth()->user()->can('orignal_store_worker'))
                                            <li>
                                                    <a data-href="{{route('original-store-worker-filling.destroy', $fill->id)}}"
                                                        class="btn text-red delete_item"><i class="fa fa-trash"></i>
                                                        @lang('lang.delete')</a>
                                            </li>
                                            @endif
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