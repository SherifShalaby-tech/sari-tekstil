@extends('layouts.app')
@section('title', __('lang.cars'))
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
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.cars')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                @if(auth()->user()->can('settings_module.cars.create'))
                <div class="widgetbar">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createCarModal"><i class="ri-add-line align-middle mr-2"></i>@lang('lang.add')</button>
                </div>                        
            </div>
        </div>          
    </div>
    <!-- End Breadcrumbbar -->
    @include('cars.create')
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
                                <th>@lang('lang.name')</th>
                                <th>@lang('lang.weight')</th>
                                <th>@lang('lang.sku')</th>
                                {{-- <th>@lang('lang.store')</th> --}}
                                <th>@lang('lang.added_by')</th>
                                <th>@lang('lang.updated_by')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cars as $index=>$car)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{$car->name}}</td>
                                <td>{{$car->weight}}</td>
                                <td>{{$car->sku}}</td>
                                {{-- <td>{{$car->store->name}}</td> --}}
                                <td>
                                    @if ($car->created_by  > 0 and $car->created_by != null)
                                        {{ $car->created_at->diffForHumans() }} <br>
                                        {{ $car->created_at->format('Y-m-d') }}
                                        ({{ $car->created_at->format('h:i') }})
                                        {{ ($car->created_at->format('A')=='AM'?__('am') : __('pm')) }}  <br>
                                        {{ $car->createBy?->name }}
                                    @else
                                    {{ __('no_update') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($car->edited_by  > 0 and $car->edited_by != null)
                                        {{ $car->updated_at->diffForHumans() }} <br>
                                        {{ $car->updated_at->format('Y-m-d') }}
                                        ({{ $car->updated_at->format('h:i') }})
                                        {{ ($car->updated_at->format('A')=='AM'?__('am') : __('pm')) }}  <br>
                                        {{ $car->updateBy?->name }}
                                    @else
                                       {{ __('no_update') }}
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">خيارات                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            @if(auth()->user()->can('settings_module.cars.edit'))
                                            <li>
                                                <a data-href="{{route('cars.edit', $car->id)}}" data-container=".view_modal" class="btn btn-modal" data-toggle="modal"><i class="dripicons-document-edit"></i> @lang('lang.update')</a>
                                            </li>
                                            @endif
                                            <li class="divider"></li>
                                            @if(auth()->user()->can('settings_module.cars.delete'))    
                                            <li>
                                                <a data-href="{{route('cars.destroy', $car->id)}}"
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
                        <div class="view_modal no-print" >
                        </div>
                    </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection