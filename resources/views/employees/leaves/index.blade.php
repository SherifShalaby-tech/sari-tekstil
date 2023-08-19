@extends('layouts.app')
@section('title', __('lang.view_list_of_employees_in_leave'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->                    
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">@lang('lang.view_list_of_employees_in_leave')</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item"><a href="{{route('employees.index')}}">{{__('lang.employees')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.view_list_of_employees_in_leave')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="widgetbar">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createColorModal"><i class="ri-add-line align-middle mr-2"></i>Add</button>
                </div>                        
            </div>
        </div>          
    </div>
    <!-- End Breadcrumbbar -->
    @include('employees.leaves.create')
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
                                <th>@lang('lang.job_title')</th>
                                <th>@lang('lang.leave_type')</th>
                                <th>@lang('lang.start_date')</th>
                                <th>@lang('lang.end_date')</th>
                                <th>@lang('lang.rejoining_date')</th>
                                <th>@lang('lang.leave_balance')</th>
                                <th>@lang('lang.added_by')</th>
                                <th>@lang('lang.updated_by')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($leaves as $index=>$leave)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{$leave->employee->name}}</td>
                                <td>
                                    {{$leave->employee->job_type->title}}
                                </td>
                                <td>
                                    {{$leave->leave_type->name}}
                                </td>
                                <td>
                                    {{@format_date($leave->start_date)}}
                                </td>
                                <td>
                                    {{@format_date($leave->end_date)}}
                                </td>
                                <td>
                                    {{@format_date($leave->rejoining_date)}}
                                </td>

                                <td>
                                    @php
                                    $balance_leaves = App\Models\Employee::getBalanceLeave($leave->employee_id);
                                    @endphp
                                    <a style="cursor: pointer;"
                                        data-href="leave/get-leave-details/{{$leave->employee_id}}?start_date={{request()->start_date}}&end_date={{request()->end_date}}"
                                        data-container=".view_modal" class="btn-modal">
                                        {{@num_format($balance_leaves)}} </a>
                                </td>
                                <td>
                                    @if ($leave->created_by  > 0 and $leave->created_by != null)
                                        {{ $leave->created_at->diffForHumans() }} <br>
                                        {{ $leave->created_at->format('Y-m-d') }}
                                        ({{ $leave->created_at->format('h:i') }})
                                        {{ ($leave->created_at->format('A')=='AM'?__('am') : __('pm')) }}  <br>
                                        {{ $leave->createBy?->name }}
                                    @else
                                    {{ __('no_update') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($leave->edited_by  > 0 and $leave->edited_by != null)
                                        {{ $leave->updated_at->diffForHumans() }} <br>
                                        {{ $leave->updated_at->format('Y-m-d') }}
                                        ({{ $leave->updated_at->format('h:i') }})
                                        {{ ($leave->updated_at->format('A')=='AM'?__('am') : __('pm')) }}  <br>
                                        {{ $leave->updateBy?->name }}
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
                                            <li>
                                                <a data-href="{{route('leaves.edit', $leave->id)}}" data-container=".view_modal" class="btn btn-modal" data-toggle="modal"><i class="dripicons-document-edit"></i> @lang('lang.update')</a>
                                            </li>
                                            <li class="divider"></li>
                                                <li>
                                                    <a data-href="{{route('leaves.destroy', $leave->id)}}"
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