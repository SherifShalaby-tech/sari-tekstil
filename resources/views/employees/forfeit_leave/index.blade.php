@extends('layouts.app')
@section('title', __('lang.list_of_employees_in_forfeit_leave'))

@section('page_title')
    @lang('lang.list_of_employees_in_forfeit_leave')
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('employees.index') }}">{{ __('lang.employees') }}</a>
    </li>
    <li class="last active"><a href="#">@lang('lang.list_of_employees_in_forfeit_leave')</a></li>
@endsection

@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                <div class="animate-in-page">
                    <div class="card p-2 mb-2  animate__animated animate__bounceInLeft" style="animation-delay: 1.5s">
                        <div class="wrapper1">
                            <div class="div1"></div>
                        </div>
                        <div class="wrapper2">
                            <div class="div2 table-scroll-wrapper">
                                <!-- content goes here -->
                                <div style="min-width: 1200px;max-height: 70vh;min-height:60vh;overflow: auto">
                                    <table id="datatable-buttons" class="table table-striped table-bordered"
                                        style="width: 100% !important">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>@lang('lang.name')</th>
                                                <th>@lang('lang.job_title')</th>
                                                <th>@lang('lang.number_of_days')</th>
                                                <th>@lang('lang.year')</th>
                                                <th>@lang('lang.added_by')</th>
                                                <th>@lang('lang.updated_by')</th>
                                                {{-- <th>@lang('lang.action')</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($forfiets as $index => $forfiet)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $forfiet->employee->name }}</td>
                                                    <td>
                                                        {{ $forfiet->employee->job_type->title }}
                                                    </td>
                                                    <td>
                                                        {{ $forfiet->leave_type->name }}
                                                    </td>
                                                    <td>
                                                        {{ @format_date($forfiet->start_date) }}
                                                    </td>
                                                    <td>
                                                        @if ($forfiet->created_by > 0 and $forfiet->created_by != null)
                                                            {{ $forfiet->created_at->diffForHumans() }} <br>
                                                            {{ $forfiet->created_at->format('Y-m-d') }}
                                                            ({{ $forfiet->created_at->format('h:i') }})
                                                            {{ $forfiet->created_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $forfiet->createBy?->name }}
                                                        @else
                                                            {{ __('no_update') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($forfiet->edited_by > 0 and $forfiet->edited_by != null)
                                                            {{ $forfiet->updated_at->diffForHumans() }} <br>
                                                            {{ $forfiet->updated_at->format('Y-m-d') }}
                                                            ({{ $forfiet->updated_at->format('h:i') }})
                                                            {{ $forfiet->updated_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $forfiet->updateBy?->name }}
                                                        @else
                                                            {{ __('no_update') }}
                                                        @endif
                                                    </td>
                                                    {{-- <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">خيارات                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <li>
                                                <a data-href="{{route('forfiets.edit', $forfiet->id)}}" data-container=".view_modal" class="btn btn-modal" data-toggle="modal"><i class="dripicons-document-edit"></i> @lang('lang.update')</a>
                                            </li>
                                            <li class="divider"></li>
                                                <li>
                                                    <a data-href="{{route('forfiets.destroy', $forfiet->id)}}"
                                                        class="btn text-red delete_item"><i class="fa fa-trash"></i>
                                                        @lang('lang.delete')</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="view_modal no-print">
                                    </div>
                                </div>
                            </div>
                            <!-- End col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
