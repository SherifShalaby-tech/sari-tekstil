@extends('layouts.app')
@section('title', __('lang.labs'))

@section('page_title')
    E-Commerce
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.labs')</a></li>
    @include('labs.create')
@endsection


@section('button')
    <button class="btn btn-primary" data-toggle="modal" data-target="#createLabModal"><i
            class="ri-add-line align-middle mr-2"></i>@lang('lang.add')</button>
@endsection

@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                <div class="animate-in-page">

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
                                                <th>@lang('lang.phone_number')</th>
                                                <th>@lang('lang.email')</th>
                                                <th>@lang('lang.manager_name')</th>
                                                <th>@lang('lang.location')</th>
                                                <th>@lang('lang.added_by')</th>
                                                <th>@lang('lang.updated_by')</th>
                                                <th>@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($labs as $index => $lab)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $lab->name }}</td>
                                                    <td>{{ $lab->phone_number ?? 'NAN' }}</td>
                                                    <td>{{ $lab->email ?? 'NAN' }}</td>
                                                    <td>{{ $lab->manager_name ?? 'NAN' }}</td>
                                                    <td>{{ $lab->location ?? 'NAN' }}</td>
                                                    <td>
                                                        @if ($lab->created_by > 0 and $lab->created_by != null)
                                                            {{ $lab->created_at->diffForHumans() }} <br>
                                                            {{ $lab->created_at->format('Y-m-d') }}
                                                            ({{ $lab->created_at->format('h:i') }})
                                                            {{ $lab->created_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $lab->createBy?->name }}
                                                        @else
                                                            {{ __('no_update') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($lab->edited_by > 0 and $lab->edited_by != null)
                                                            {{ $lab->updated_at->diffForHumans() }} <br>
                                                            {{ $lab->updated_at->format('Y-m-d') }}
                                                            ({{ $lab->updated_at->format('h:i') }})
                                                            {{ $lab->updated_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $lab->updateBy?->name }}
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
                                                                <li>
                                                                    <a data-href="{{ route('lab.edit', $lab->id) }}"
                                                                        data-container=".view_modal" class=" btn-modal"
                                                                        data-toggle="modal"><i
                                                                            class="dripicons-document-edit"></i>
                                                                        @lang('lang.update')</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <a data-href="{{ route('lab.destroy', $lab->id) }}"
                                                                        class=" delete_item"><i class="fa fa-trash"></i>
                                                                        @lang('lang.delete')</a>
                                                                </li>
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
                </div>
            </div>
        </div>
        <!-- End Contentbar -->
    @endsection
