@extends('layouts.app')
@section('title', __('lang.tying_bales'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->                    
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">{{__('lang.tying_bales')}}</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item"><a href="{{route('tying-bales.index')}}">{{__('lang.bales')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.tying_bales')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                @if(auth()->user()->can('compression_worker'))
                <div class="widgetbar">
                    <a href="{{route('tying-bales.create')}}" class="btn btn-primary" ><i class="ri-add-line align-middle mr-2"></i>@lang('lang.add')</a>
                </div>    
                @endif                    
            </div>
        </div>          
    </div>
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
                                <th>@lang('lang.bales_skus')</th>
                                <th>@lang('lang.weight')</th>
                                <th>@lang('lang.added_by')</th>
                                <th>@lang('lang.updated_by')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bales as $index=>$bale)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>
                                   {{$bale->fill_press_request1->sku}}<br>
                                   {{$bale->fill_press_request2->sku}}<br>
                                   {{$bale->fill_press_request3->sku}}<br>
                                   {{$bale->fill_press_request4->sku}}<br>
                                </td>
                                <td>
                                    {{$bale->fill_press_request1->weight}} Kg <br>
                                    {{$bale->fill_press_request2->weight}} Kg <br>
                                    {{$bale->fill_press_request3->weight}} Kg <br>
                                    {{$bale->fill_press_request4->weight}} Kg <br>
                                 </td>
                                <td>
                                    @if ($bale->created_by  > 0 and $bale->created_by != null)
                                        {{ $bale->created_at->diffForHumans() }} <br>
                                        {{ $bale->created_at->format('Y-m-d') }}
                                        ({{ $bale->created_at->format('h:i') }})
                                        {{ ($bale->created_at->format('A')=='AM'?__('am') : __('pm')) }}  <br>
                                        {{ $bale->createBy?->name }}
                                    @else
                                    {{ __('no_update') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($bale->edited_by  > 0 and $bale->edited_by != null)
                                        {{ $bale->updated_at->diffForHumans() }} <br>
                                        {{ $bale->updated_at->format('Y-m-d') }}
                                        ({{ $bale->updated_at->format('h:i') }})
                                        {{ ($bale->updated_at->format('A')=='AM'?__('am') : __('pm')) }}  <br>
                                        {{ $bale->updateBy?->name }}
                                    @else
                                       {{ __('no_update') }}
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">خيارات                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            @if(auth()->user()->can('settings_module.types.edit'))
                                            <li>
                                                <a data-href="{{route('tying-bales.edit', $bale->id)}}" data-container=".view_modal" class="btn btn-modal" data-toggle="modal"><i class="dripicons-document-edit"></i> @lang('lang.update')</a>
                                            </li>
                                            @endif
                                            <li class="divider"></li>
                                            @if(auth()->user()->can('settings_module.types.delete'))
                                            <li>
                                                    <a data-href="{{route('tying-bales.destroy', $bale->id)}}"
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