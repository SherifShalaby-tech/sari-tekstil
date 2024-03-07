@extends('layouts.app')
@section('title', __('lang.calibers'))

@section('page_title')
    E-Commerce
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.calibers')</a></li>
    @include('calibers.create')
@endsection

@section('button')
    <button class="button" id="centered-toggle-button" onclick="toggleModal()">
        <div class="button-wrapper">
            <div class="text">@lang('lang.add')</div>
            <span class="icon">
                <i class="fas fa-plus text-white"></i>
            </span>
        </div>
    </button>

    {{-- <div class="widgetbar">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#createCaliberModal"><i
                            class="ri-add-line align-middle mr-2"></i>Add</button>
                </div> --}}
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
                                <th>@lang('lang.number')</th>
                                <th>@lang('lang.store')</th>
                                <th>@lang('lang.added_by')</th>
                                <th>@lang('lang.updated_by')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($calibers as $index => $caliber)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $caliber->number }}</td>
                                    <td>{{ $caliber->store->name }}</td>
                                    <td>
                                        @if ($caliber->created_by > 0 and $caliber->created_by != null)
                                            {{ $caliber->created_at->diffForHumans() }} <br>
                                            {{ $caliber->created_at->format('Y-m-d') }}
                                            ({{ $caliber->created_at->format('h:i') }})
                                            {{ $caliber->created_at->format('A') == 'AM' ? __('am') : __('pm') }} <br>
                                            {{ $caliber->createBy?->name }}
                                        @else
                                            {{ __('no_update') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($caliber->edited_by > 0 and $caliber->edited_by != null)
                                            {{ $caliber->updated_at->diffForHumans() }} <br>
                                            {{ $caliber->updated_at->format('Y-m-d') }}
                                            ({{ $caliber->updated_at->format('h:i') }})
                                            {{ $caliber->updated_at->format('A') == 'AM' ? __('am') : __('pm') }} <br>
                                            {{ $caliber->updateBy?->name }}
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
                                                <li>
                                                    <a data-href="{{ route('calibers.edit', $caliber->id) }}"
                                                        data-container=".view_modal" class="btn btn-modal"
                                                        data-toggle="modal"><i class="dripicons-document-edit"></i>
                                                        @lang('lang.update')</a>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a data-href="{{ route('calibers.destroy', $caliber->id) }}"
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
