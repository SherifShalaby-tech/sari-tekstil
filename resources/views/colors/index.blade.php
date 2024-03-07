@extends('layouts.app')
@section('title', __('lang.colors'))

@section('page_title')
    {{ __('lang.colors') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.colors')</a></li>
    @include('colors.create')
@endsection

@if (auth()->user()->can('settings_module.colors.create'))
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
                            @foreach ($colors as $index => $color)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $color->name }}</td>
                                    <td>
                                        @if ($color->created_by > 0 and $color->created_by != null)
                                            {{ $color->created_at->diffForHumans() }} <br>
                                            {{ $color->created_at->format('Y-m-d') }}
                                            ({{ $color->created_at->format('h:i') }})
                                            {{ $color->created_at->format('A') == 'AM' ? __('am') : __('pm') }} <br>
                                            {{ $color->createBy?->name }}
                                        @else
                                            {{ __('no_update') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($color->edited_by > 0 and $color->edited_by != null)
                                            {{ $color->updated_at->diffForHumans() }} <br>
                                            {{ $color->updated_at->format('Y-m-d') }}
                                            ({{ $color->updated_at->format('h:i') }})
                                            {{ $color->updated_at->format('A') == 'AM' ? __('am') : __('pm') }} <br>
                                            {{ $color->updateBy?->name }}
                                        @else
                                            {{ __('no_update') }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button color="button" class="btn btn-default btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">خيارات
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                                user="menu" x-placement="bottom-end"
                                                style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                @if (auth()->user()->can('settings_module.colors.edit'))
                                                    <li>
                                                        <a data-href="{{ route('colors.edit', $color->id) }}"
                                                            data-container=".view_modal" class="btn btn-modal"
                                                            data-toggle="modal"><i class="dripicons-document-edit"></i>
                                                            @lang('lang.update')</a>
                                                    </li>
                                                @endif
                                                <li class="divider"></li>
                                                @if (auth()->user()->can('settings_module.colors.delete'))
                                                    <li>
                                                        <a data-href="{{ route('colors.destroy', $color->id) }}"
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
