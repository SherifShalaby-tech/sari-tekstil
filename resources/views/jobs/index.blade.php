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
        <button class="btn btn-primary" data-toggle="modal" data-target="#createJobModal"><i
                class="ri-add-line align-middle mr-2"></i>@lang('lang.add')</button>
    @endsection
@endif








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
                                            {{ $job->created_at->format('A') == 'AM' ? __('am') : __('pm') }} <br>
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
                                            {{ $job->updated_at->format('A') == 'AM' ? __('am') : __('pm') }} <br>
                                            {{ $job->updateBy?->name }}
                                        @else
                                            {{ __('no_update') }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button job="button" class="btn btn-default btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">خيارات
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                                user="menu" x-placement="bottom-end"
                                                style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                @if (auth()->user()->can('employees_module.jobs.edit'))
                                                    <li>
                                                        <a data-href="{{ route('jobs.edit', $job->id) }}"
                                                            data-container=".view_modal" class="btn btn-modal"
                                                            data-toggle="modal"><i class="dripicons-document-edit"></i>
                                                            @lang('lang.update')</a>
                                                    </li>
                                                @endif
                                                <li class="divider"></li>
                                                @if (auth()->user()->can('employees_module.jobs.delete'))
                                                    <li>
                                                        <a data-href="{{ route('jobs.destroy', $job->id) }}"
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
                    <div class="view_modal no-print">
                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
