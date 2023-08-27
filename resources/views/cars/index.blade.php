@extends('layouts.app')
@section('title', __('lang.cars'))
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
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.cars')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3  col-lg-3 d-flex">
                @if(auth()->user()->can('settings_module.cars.create'))
                <div class="widgetbar">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createCarModal"><i class="ri-add-line align-middle mr-2"></i>@lang('lang.add')</button>
                </div>   
                @endif  
                &nbsp;&nbsp;&nbsp;                   
                @if(auth()->user()->can('settings_module.cars.create'))
                <div class="widgetbar">
                    <a href="{{route('planning-carts.index')}}" class="btn btn-warning"><i class="ri-add-line align-middle mr-2"></i>@lang('lang.planning_carts')</a>
                </div>   
                @endif                     
            </div>
        </div>          
    </div>
    <!-- End Breadcrumbbar -->
    @include('cars.create')
@endsection
@section('content')
    <!-- Start Contentbar -->    
    <div class="contentbar">
        <div class="row">
            <div class="col-lg-12">
                <div class="container-fluid">
                    @include('cars.partials.filters',['url'=>'cars.index'])
                </div>
            </div>
        </div>
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12 col-xl-12">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered ">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('lang.branch')</th>
                                <th>@lang('lang.sku')</th>
                                <th>@lang('lang.name')</th>
                                <th>@lang('lang.weight_empty')</th>
                                <th>@lang('lang.recent_process')</th>
                                <th>@lang('lang.recent_car_content')</th>
                                <th>@lang('lang.caliber')</th>
                                <th>@lang('lang.employee')</th>
                                <th>@lang('lang.weight_product')</th>
                                <th class="text-center">@lang('lang.status')</th>
                                <th>@lang('lang.added_by')</th>
                                <th>@lang('lang.updated_by')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cars as $index=>$car)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{$car->branch->name}}</td>
                                <td>{{$car->sku}}</td>
                                <td>{{$car->name}}</td>
                                {{-- <td> {!! Form::text('discount[]',  @num_format(444), ['class' => 'clear_input_form form-control', 'placeholder' => __('lang.discount')]) !!}</td> --}}
                                <td>{{@num_format($car->weight_empty)}} KG</td>
                                <td>{{__('lang.'.$car->process)}}</td>
                                <td class="text-center">{{$car->recent_car_content}}</td>
                                <td class="text-center">{{!empty($car->caliber)?$car->caliber->number:'-'}}</td>
                                <td class="text-center">{{!empty($car->employee)?$car->employee->name:'-'}}</td>
                                <td>{{@num_format($car->weight_product)}} KG</td>
                                <td>
                                    @if($car->status==0)
                                    <span class="d-flex change-car-status" data-car="{{$car->id}}">
                                        <img src="{{asset('images/empty-box.jpg')}}"  width="50px" height="70px" class="img-status"/>
                                        <span class="word-status">@lang('lang.empty')</span></span>
                                    @else
                                    <span class="d-flex change-car-status" data-car="{{$car->id}}">
                                        <img src="{{asset('images/full-box.jpg')}}"  width="50px" height="70px" class="img-status"/>
                                        <span class="word-status">@lang('lang.occuppied')</span></span>
                                    @endif    
                                </td>
                                {{-- <td>{{$car->store->name}}</td> --}}
                                {{-- <td>{{\Illuminate\Support\Str::limit($car->notes, $limit = 100, $end = '...') }}</td> --}}
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
                                                <a data-href="{{route('maintain-car.edit', $car->id)}}" data-container=".view_modal" class="btn btn-modal maintain-url" data-toggle="modal" style="{{$car->status==0?'pointer-events: none;color: rgb(168, 165, 165);':''}}">
                                                    @if($car->expense_car)
                                                        <span class="text-danger"><i class="dripicons-document-edit"></i> @lang('lang.under_maintainance')</span>
                                                    @else
                                                        <span><i class="dripicons-document-edit"></i> @lang('lang.maintain_car')</span>
                                                    @endif
                                                </a>
                                                
                                            </li>
                                            @endif
                                            @if(auth()->user()->can('settings_module.cars.edit') || auth()->user()->can('settings_module.cars.create'))
                                            <li>
                                                <a data-href="{{route('planning-carts.edit', $car->id)}}" data-container=".view_modal" class="btn btn-modal" data-toggle="modal">
                                                    <span><i class="dripicons-document-add"></i> @lang('lang.add_aplan')</span>
                                                </a>
                                            </li>
                                            @endif
                                            @if(auth()->user()->can('settings_module.cars.edit') || auth()->user()->can('settings_module.cars.create'))
                                            <li>
                                                <span class="btn add-barcode" data-car="{{$car->id}}" style="{{$car->status==1?'pointer-events: none;color: rgb(168, 165, 165);cursor: not-allowed;':''}}">
                                                    <span><i class="dripicons-document-add"></i> @lang('lang.add_barcode')</span>
                                                </span>
                                            </li>
                                            @endif
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
@push('javascripts')
<script src="{{asset('app-js/planning_carts.js')}}" ></script>
<script>
    $(document).on('click','.change-car-status',function (e) {  
        $.ajax({
            type: "get",
            url: "/cars/change-status/"+$(this).data('car'),
            success: function (response) {
                if(response.status==1){
                    $('.img-status').attr('src','{{asset('images/full-box.jpg')}}');
                    $('.word-status').text("{{__('lang.occuppied')}}");
                    $(".maintain-url").css("pointer-events", "auto");
                    $(".maintain-url").css("color", "black");
                    $('.add-barcode').css("pointer-events", "none");
                    $('.add-barcode').css("color", "gray");
                }else if(response.status==0){
                    $('.img-status').attr('src','{{asset('images/empty-box.jpg')}}');
                    $('.word-status').text("{{__('lang.empty')}}");
                    $(".maintain-url").css("pointer-events", "none");
                    $(".maintain-url").css("color", "gray");
                    $('.add-barcode').css("pointer-events", "auto");
                    $('.add-barcode').css("color", "black");
                }
            }
        });
    });
   
</script>
@endpush