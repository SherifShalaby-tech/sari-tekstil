@extends('layouts.app')
@section('title', __('lang.nationalities'))

@section('page_title')
    {{ __('lang.nationalities') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.nationalities')</a></li>
    @include('nationalities.create')
@endsection

@if (auth()->user()->can('settings_module.nationalities.create'))
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
                                            @foreach ($nationalities as $index => $nationality)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $nationality->name }}</td>
                                                    <td>
                                                        @if ($nationality->created_by > 0 and $nationality->created_by != null)
                                                            {{ $nationality->created_at->diffForHumans() }} <br>
                                                            {{ $nationality->created_at->format('Y-m-d') }}
                                                            ({{ $nationality->created_at->format('h:i') }})
                                                            {{ $nationality->created_at->format('A') == 'AM' ? __('am') : __('pm') }}

                                                            {{ $nationality->createBy?->name }}
                                                        @else
                                                            {{ __('no_update') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($nationality->edited_by > 0 and $nationality->edited_by != null)
                                                            {{ $nationality->updated_at->diffForHumans() }} <br>
                                                            {{ $nationality->updated_at->format('Y-m-d') }}
                                                            ({{ $nationality->updated_at->format('h:i') }})
                                                            {{ $nationality->updated_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $nationality->updateBy?->name }}
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
                                                                @if (auth()->user()->can('settings_module.nationalities.edit'))
                                                                    <li>
                                                                        <button
                                                                            onclick="toggleEditModal({{ $nationality->id }})"><i
                                                                                class="dripicons-document-edit"></i>
                                                                            @lang('lang.update')</button>
                                                                    </li>
                                                                @endif
                                                                <li class="divider"></li>
                                                                @if (auth()->user()->can('settings_module.nationalities.delete'))
                                                                    <li>
                                                                        <a data-href="{{ route('nationality.destroy', $nationality->id) }}"
                                                                            class="btn text-red delete_item"><i
                                                                                class="fa fa-trash"></i>
                                                                            @lang('lang.delete')</a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @include('nationalities.edit')
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
                </div>
            </div>
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
