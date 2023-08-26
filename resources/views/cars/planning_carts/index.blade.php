@extends('layouts.app')
@section('title', __('lang.planning_carts'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->                    
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-9 col-lg-9">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">@lang('lang.planning_carts')</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item"><a href="{{route('cars.index')}}">{{__('lang.cars')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.planning_carts')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>          
    </div>
@endsection
@section('content')
    <!-- Start Contentbar -->    
    <div class="contentbar ">
        <div class="row">
            <div class="col-lg-12">
                <div class="container-fluid">
                    @include('cars.partials.filters',['url'=>'planning-carts.index'])
                </div>
            </div>
        </div>
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12 col-xl-12">
                <div class="scrollable-div">
                    <div class="table-responsive " >
                        <table id="datatable-buttons" class="table table-striped table-bordered ">
                            {{-- <table id="datatable-buttons" class="display table table-striped table-bordered dataTable dtr-inline collapsed" role="grid" aria-describedby="default-datatable_info" >    --}}
                            <thead>
                            <tr>
                                <th>#</th>
                                <th style="width:8%">@lang('lang.sku')</th>
                                <th style="width:5%">@lang('lang.name')</th>
                                <th style="width:2%">@lang('lang.status')</th>
                                <th style="width:10%">@lang('lang.weight_empty')</th>
                                <th style="width:10%">@lang('lang.recent_process')</th>
                                <th style="width:10%">@lang('lang.recent_car_content')</th>
                                <th style="width:10%">@lang('lang.recent_place')</th>
                                <th style="width:10%">@lang('lang.employee')</th>
                                <th style="width:10%">@lang('lang.weight_product')</th>
                                <th style="width:10%">@lang('lang.next_process') </th>
                                <th style="width:6%">@lang('lang.caliber')</th>
                                <th style="width:10%">@lang('lang.next_employee')</th>
                                {{-- <th>@lang('lang.added_by')</th>
                                <th>@lang('lang.updated_by')</th> --}}
                                {{-- <th>@lang('lang.action')</th> --}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cars as $index=>$car)
                            <tr>
                                <td>
                                    <input type="hidden" value="{{$car->id}}" name="id"/>
                                    {{ $index+1 }}
                                </td>
                                <td>
                                    {!! Form::text('sku',  $car->sku, ['class' => 'form-control sku', 'placeholder' => __('lang.sku'),'data-val'=>$car->sku,!$disabled?'disabled':'']) !!}
                                </td>
                                <td>{{$car->name}}</td>
                                <td>
                                @if($car->weight_empty==0)
                                    <span class="text-danger">@lang('lang.empty')</span>
                                @else
                                    <span class="text-primary">@lang('lang.occuppied')</span>
                                @endif    
                                </td>
                                <td class="d-flex justify-content-between">
                                    {!! Form::number('weight_empty',  @num_format($car->weight_empty), ['class' => 'form-control weight_empty', 'placeholder' => '0.00','data-val'=>$car->weight_empty,!$disabled?'disabled':'']) !!}
                                    &nbsp;<span class="pt-2">Kg</span></td>
                                <td>
                                    {!! Form::select('process', $processes,  !empty($car->process)?$car->process:NULL, ['class' => 'selectpicker form-control process', 'data-live-search' => 'true', 'placeholder' => '-','data-index'=>$index,!$disabled?'disabled':'']) !!}
                                </td>
                                <td>
                                    {!! Form::text('recent_car_content', !empty($car->recent_car_content)?$car->recent_car_content:null, ['class' => 'form-control recent_car_content', 'placeholder' => '-','data-val'=>$car->sku,!$disabled?'disabled':'']) !!}
                                </td>
                                <td>
                                    {!! Form::select('recent_place', $places,  NULL, ['class' => 'selectpicker form-control', 'data-live-search' => 'true', 'placeholder' => '-',!$disabled?'disabled':'']) !!}
                                </td>
                                <td>
                                    {!! Form::select('employee_id', $employees,  !empty($car->employee)?$car->employee_id:null, ['class' => 'selectpicker form-control employee_id', 'data-live-search' => 'true', 'placeholder' =>'-',!$disabled?'disabled':'']) !!}
                                </td>
                                <td class="d-flex justify-content-between">
                                    {!! Form::number('weight_product',  @num_format($car->weight_product), ['class' => 'form-control weight_product', 'placeholder' =>'0.00','data-val'=>$car->weight_product,!$disabled?'disabled':'']) !!}
                                    &nbsp;<span class="pt-2">Kg</span></td>
                                <td>
                                    {!! Form::select('next_process', $processes,  !empty($car->next_process)?$car->next_process:NULL, ['class' => 'selectpicker form-control next_process', 'data-live-search' => 'true', 'placeholder' => '-','data-index'=>$index,!$disabled?'disabled':'']) !!}
                                </td>
                                <td >
                                    {!! Form::select('caliber_id', $calibars,  !empty($car->caliber_id)?$car->caliber_id:NULL, ['class' => 'selectpicker form-control caliber_id', 'data-live-search' => 'true', 'placeholder' => '-','data-index'=>$index,!$disabled?'disabled':'']) !!}
                                </td>
                                <td>
                                    {!! Form::select('next_employee_id', $employees,  !empty($car->next_employee_id)?$car->next_employee_id:null, ['class' => 'selectpicker form-control next_employee_id', 'data-live-search' => 'true', 'placeholder' => '-','data-index'=>$index,!$disabled?'disabled':'']) !!}
                                </td>
                                {{-- <td>{{\Illuminate\Support\Str::limit($car->notes, $limit = 100, $end = '...') }}</td> --}}
                                {{-- <td>
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
                                </td> --}}
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="view_modal no-print" >
                        </div>
                    </div>
                </div>
            </div>
            @if($disabled && !empty($cars))
                <div class="col-lg-12 col-xl-12">
                    <button  id="save" class="btn btn-primary">{{__('lang.save')}}</button>
                    <button  id="save-print" data-print="1"  class="btn btn-danger">{{__('lang.save_and_print')}}</button>
                </div>
            @endif
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->

@endsection
@push('javascripts')
<script src="{{asset('app-js/planning_carts.js')}}" ></script>
@endpush