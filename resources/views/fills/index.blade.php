@extends('layouts.app')
@section('title', __('lang.fills'))

@section('page_title')
    {{ __('lang.fills') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.pressing_requests')</a></li>
    @include('fills.create')
@endsection

@if (auth()->user()->can('settings_module.fills.create'))
    @section('button')
        <button class="button" id="centered-toggle-button" onclick="toggleModal()">
            <div class="button-wrapper">
                <div class="text">@lang('lang.add')</div>
                <span class="icon">
                    <i class="fas fa-plus text-white"></i>
                </span>
            </div>
        </button>
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#createFillModal"><i
                class="ri-add-line align-middle mr-2"></i>@lang('lang.add')</button> --}}
    @endsection
@endif

@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                <div class="card p-2 mb-2">
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
                                        @foreach ($fills as $index => $fill)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $fill->name }}</td>
                                                <td>
                                                    @if ($fill->created_by > 0 and $fill->created_by != null)
                                                        {{ $fill->created_at->diffForHumans() }} <br>
                                                        {{ $fill->created_at->format('Y-m-d') }}
                                                        ({{ $fill->created_at->format('h:i') }})
                                                        {{ $fill->created_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                        <br>
                                                        {{ $fill->createBy?->name }}
                                                    @else
                                                        {{ __('no_update') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($fill->edited_by > 0 and $fill->edited_by != null)
                                                        {{ $fill->updated_at->diffForHumans() }} <br>
                                                        {{ $fill->updated_at->format('Y-m-d') }}
                                                        ({{ $fill->updated_at->format('h:i') }})
                                                        {{ $fill->updated_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                        <br>
                                                        {{ $fill->updateBy?->name }}
                                                    @else
                                                        {{ __('no_update') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button fill="button"
                                                            class="btn btn-default btn-sm dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">خيارات
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                                            user="menu" x-placement="bottom-end"
                                                            style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            @if (auth()->user()->can('settings_module.fills.edit'))
                                                                <li>
                                                                    <button
                                                                        onclick="toggleEditModal({{ $fill->id }})"><i
                                                                            class="dripicons-document-edit"></i>
                                                                        @lang('lang.update')</button>
                                                                </li>
                                                            @endif
                                                            <li class="divider"></li>
                                                            @if (auth()->user()->can('settings_module.fills.delete'))
                                                                <li>
                                                                    <a data-href="{{ route('fills.destroy', $fill->id) }}"
                                                                        class="btn text-red delete_item"><i
                                                                            class="fa fa-trash"></i>
                                                                        @lang('lang.delete')</a>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @include('fills.edit')
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
            </div>
        </div>
    </div>
    <!-- End Contentbar -->
@endsection
