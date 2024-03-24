@extends('layouts.app')
@section('title', __('lang.jobs'))

@section('page_title')
    {{ __('lang.jobs') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.jobs')</a></li>
    @include('jobs.create')
@endsection

@if (auth()->user()->can('employees_module.jobs.create'))
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
                                                <th>@lang('lang.added_by')</th>
                                                <th>@lang('lang.updated_by')</th>
                                                <th>@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jobs as $index => $job)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $job->title }}</td>
                                                    <td>
                                                        @if ($job->created_by > 0 and $job->created_by != null)
                                                            {{ $job->created_at->diffForHumans() }} <br>
                                                            {{ $job->created_at->format('Y-m-d') }}
                                                            ({{ $job->created_at->format('h:i') }})
                                                            {{ $job->created_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $job->createBy?->name }}
                                                        @else
                                                            {{ __('no_update') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($job->edited_by > 0 and $job->edited_by != null)
                                                            {{ $job->updated_at->diffForHumans() }} <br>
                                                            {{ $job->updated_at->format('Y-m-d') }}
                                                            ({{ $job->updated_at->format('h:i') }})
                                                            {{ $job->updated_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $job->updateBy?->name }}
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
                                                                @if (auth()->user()->can('employees_module.jobs.edit'))
                                                                    <li>
                                                                        <button
                                                                            onclick="toggleEditModal({{ $job->id }})"><i
                                                                                class="dripicons-document-edit"></i>
                                                                            @lang('lang.update')</button>
                                                                    </li>
                                                                @endif
                                                                <li class="divider"></li>
                                                                @if (auth()->user()->can('employees_module.jobs.delete'))
                                                                    <li>
                                                                        <a data-href="{{ route('jobs.destroy', $job->id) }}"
                                                                            class=" delete_item"><i class="fa fa-trash"></i>
                                                                            @lang('lang.delete')</a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @include('jobs.edit')
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="view_modal no-print">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End col -->
                    </div>
                    <!-- End row -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Contentbar -->
@endsection
