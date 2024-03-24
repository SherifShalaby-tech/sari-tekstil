@extends('layouts.app')
@section('title', __('lang.tying_bales'))

@section('page_title')
    {{ __('lang.tying_bales') }}
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('tying-bales.index') }}">@lang('lang.tying_bales')</a></li>
    <li class="last active"><a href="#">@lang('lang.tying_bales')</a></li>
@endsection

@if (auth()->user()->can('compression_worker'))

    @section('button')
        <a class="button" href="{{ route('tying-bales.create') }}">
            <div class="button-wrapper">
                <div class="text">@lang('lang.add')</div>
                <span class="icon">
                    <i class="fas fa-plus text-white"></i>
                </span>
            </div>
        </a>
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
                                                <th>@lang('lang.bales_skus')</th>
                                                <th>@lang('lang.weight')</th>
                                                <th>@lang('lang.added_by')</th>
                                                <th>@lang('lang.updated_by')</th>
                                                <th>@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bales as $index => $bale)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        {{ $bale->fill_press_request1->sku }}<br>
                                                        {{ $bale->fill_press_request2->sku }}<br>
                                                        {{ $bale->fill_press_request3->sku }}<br>
                                                        {{ $bale->fill_press_request4->sku }}<br>
                                                    </td>
                                                    <td>
                                                        {{ $bale->fill_press_request1->weight }} Kg <br>
                                                        {{ $bale->fill_press_request2->weight }} Kg <br>
                                                        {{ $bale->fill_press_request3->weight }} Kg <br>
                                                        {{ $bale->fill_press_request4->weight }} Kg <br>
                                                    </td>
                                                    <td>
                                                        @if ($bale->created_by > 0 and $bale->created_by != null)
                                                            {{ $bale->created_at->diffForHumans() }} <br>
                                                            {{ $bale->created_at->format('Y-m-d') }}
                                                            ({{ $bale->created_at->format('h:i') }})
                                                            {{ $bale->created_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $bale->createBy?->name }}
                                                        @else
                                                            {{ __('no_update') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($bale->edited_by > 0 and $bale->edited_by != null)
                                                            {{ $bale->updated_at->diffForHumans() }} <br>
                                                            {{ $bale->updated_at->format('Y-m-d') }}
                                                            ({{ $bale->updated_at->format('h:i') }})
                                                            {{ $bale->updated_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $bale->updateBy?->name }}
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
                                                                @if (auth()->user()->can('settings_module.types.edit'))
                                                                    <li>
                                                                        <a data-href="{{ route('tying-bales.edit', $bale->id) }}"
                                                                            data-container=".view_modal" class=" btn-modal"
                                                                            data-toggle="modal"><i
                                                                                class="dripicons-document-edit"></i>
                                                                            @lang('lang.update')</a>
                                                                    </li>
                                                                @endif
                                                                <li class="divider"></li>
                                                                @if (auth()->user()->can('settings_module.types.delete'))
                                                                    <li>
                                                                        <a data-href="{{ route('tying-bales.destroy', $bale->id) }}"
                                                                            class=" delete_item"><i class="fa fa-trash"></i>
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
