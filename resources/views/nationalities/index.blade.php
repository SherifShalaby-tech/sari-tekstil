@extends('layouts.app')
@section('title', __('lang.nationalities'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="media">
                    <div class="wrapper">
                        <div class="description">
                            <h3>{{ __('lang.nationalities') }}</h3>
                        </div>
                        <ul class="breadcrumbs">
                            <li class="first"><a href="{{ url('/') }}" class=""><i class="fas fa-home"></i></a>
                            </li>
                            <li><a href="#">{{ __('lang.dashboard') }}</a>
                            </li>
                            <li class="last active"><a href="#">@lang('lang.nationalities')</a></li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                @if (auth()->user()->can('settings_module.nationalities.create'))
                    <div class="widgetbar">

                        <button class="button" id="centered-toggle-button" onclick="toggleModal()">
                            <div class="button-wrapper">
                                <div class="text">@lang('lang.add')</div>
                                <span class="icon">
                                    <i class="fas fa-plus text-white"></i>
                                </span>
                            </div>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- End Breadcrumbbar -->
    @include('nationalities.create')
@endsection

@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered" style="width: 100%">
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
                                            <br>
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
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">خيارات
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                                user="menu" x-placement="bottom-end"
                                                style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                @if (auth()->user()->can('settings_module.nationalities.edit'))
                                                    <li>
                                                        <a data-href="{{ route('nationality.edit', $nationality->id) }}"
                                                            data-container=".view_modal" class="btn btn-modal"
                                                            data-toggle="modal"><i class="dripicons-document-edit"></i>
                                                            @lang('lang.update')</a>
                                                    </li>
                                                @endif
                                                <li class="divider"></li>
                                                @if (auth()->user()->can('settings_module.nationalities.delete'))
                                                    <li>
                                                        <a data-href="{{ route('nationality.destroy', $nationality->id) }}"
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
