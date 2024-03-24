@extends('layouts.app')
@section('title', __('lang.leave_types'))

@section('page_title')
    {{ __('lang.leave_types') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.leave_types')</a></li>
    @include('employees.leave_types.create')
@endsection

@if (auth()->user()->can('employees_module.leave_types.create'))
    {{-- @section('button')
        <div class="widgetbar">
            <button class="btn btn-primary" data-toggle="modal" data-target="#createJobModal"><i
                    class="ri-add-line align-middle mr-2"></i>@lang('lang.add')</button>
        </div>
    @endsection --}}

    @section('button')
        <button class="button" id="centered-toggle-button" onclick="toggleModal()">
            <div class="button-wrapper">
                <div class="text">@lang('lang.add')</div>
                <span class="icon">
                    <i class="fas fa-plus text-white"></i>
                </span>
            </div>
        </button>
    @endsection
@endif

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
                                                <th>@lang('lang.number_of_days_per_year')</th>
                                                <th>@lang('lang.added_by')</th>
                                                <th>@lang('lang.updated_by')</th>
                                                <th>@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($leave_types as $index => $leave_type)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $leave_type->name }}</td>
                                                    <td>{{ $leave_type->number_of_days_per_year }}</td>
                                                    <td>
                                                        @if ($leave_type->created_by > 0 and $leave_type->created_by != null)
                                                            {{ $leave_type->created_at->diffForHumans() }} <br>
                                                            {{ $leave_type->created_at->format('Y-m-d') }}
                                                            ({{ $leave_type->created_at->format('h:i') }})
                                                            {{ $leave_type->created_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $leave_type->createBy?->name }}
                                                        @else
                                                            {{ __('no_update') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($leave_type->edited_by > 0 and $leave_type->edited_by != null)
                                                            {{ $leave_type->updated_at->diffForHumans() }} <br>
                                                            {{ $leave_type->updated_at->format('Y-m-d') }}
                                                            ({{ $leave_type->updated_at->format('h:i') }})
                                                            {{ $leave_type->updated_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $leave_type->updateBy?->name }}
                                                        @else
                                                            {{ __('no_update') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class=" cd-dropdown-wrapper">
                                                            <button fill="button"
                                                                class="cd-dropdown-trigger dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">خيارات
                                                                <span class="caret"></span>
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <ul class="dropdown-menu cd-dropdown-content edit-options dropdown-menu-right dropdown-default"
                                                                user="menu" x-placement="bottom-end"
                                                                style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                @if (auth()->user()->can('employees_module.leave_types.edit'))
                                                                    <li>

                                                                        <button
                                                                            onclick="toggleEditModal({{ $leave_type->id }})"><i
                                                                                class="dripicons-document-edit"></i>
                                                                            @lang('lang.update')</button>
                                                                    </li>
                                                                @endif
                                                                <li class="divider"></li>
                                                                @if (auth()->user()->can('employees_module.leave_types.delete'))
                                                                    <li>
                                                                        <a data-href="{{ route('leave_types.destroy', $leave_type->id) }}"
                                                                            class=" delete_item"><i class="fa fa-trash"></i>
                                                                            @lang('lang.delete')</a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @include('employees.leave_types.edit')
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="view_modal no-print">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
