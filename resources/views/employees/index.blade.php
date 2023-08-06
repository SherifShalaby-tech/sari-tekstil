@extends('layouts.app')
@section('title', __('lang.employees'))
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
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.employees')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="widgetbar">
                    <a href="{{route('employees.create')}}" class="btn btn-primary"><i class="ri-add-line align-middle mr-2"></i>Add</a>
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
                                <th>@lang('lang.name')</th>
                                <th>@lang('lang.responsable_name')</th>
                                <th>@lang('lang.email')</th>
                                <th>@lang('lang.phone_numbers')</th>
                                <th>@lang('lang.country')</th>
                                <th>@lang('lang.company_address')</th>
                                <th>@lang('lang.shipping_address')</th>
                                <th>@lang('lang.added_by')</th>
                                <th>@lang('lang.updated_by')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $index=>$employee)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{$employee->name}}</td>
                                {{-- <td>{{$employee->user->name}}</td>
                                <td>
                                    @for($i=0;$i<count($employee->emails);$i++)
                                    {{$employee->emails[$i]}}<br>
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($employee->phones);$i++)
                                    {{$employee->phones[$i]}}<br>
                                    @endfor
                                </td>
                                <td>{{$employee->country}}</td>
                                <td>{{$employee->company_address}}</td>
                                <td>{{$employee->shipping_address}}</td> --}}
                                <td>
                                    @if ($employee->created_by  > 0 and $employee->created_by != null)
                                        {{ $employee->created_at->diffForHumans() }} <br>
                                        {{ $employee->created_at->format('Y-m-d') }}
                                        ({{ $employee->created_at->format('h:i') }})
                                        {{ ($employee->created_at->format('A')=='AM'?__('am') : __('pm')) }}  <br>
                                        {{ $employee->createBy?->name }}
                                    @else
                                    {{ __('no_update') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($employee->edited_by  > 0 and $employee->edited_by != null)
                                        {{ $employee->updated_at->diffForHumans() }} <br>
                                        {{ $employee->updated_at->format('Y-m-d') }}
                                        ({{ $employee->updated_at->format('h:i') }})
                                        {{ ($employee->updated_at->format('A')=='AM'?__('am') : __('pm')) }}  <br>
                                        {{ $employee->updateBy?->name }}
                                    @else
                                       {{ __('no_update') }}
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button employee="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">خيارات                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <li>
                                                <a href="{{route('employees.edit', $employee->id)}}" class="btn"><i class="dripicons-document-edit"></i> @lang('lang.update')</a>
                                            </li>
                                            <li class="divider"></li>
                                                <li>
                                                    <a data-href="{{route('employees.destroy', $employee->id)}}"
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