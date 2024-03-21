@extends('layouts.app')
@section('title', __('lang.screening'))

@section('page_title')
    Tekstil
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.stores')</a></li>
    @include('store_categories.create')
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
@endsection

@php
    $branches = App\Models\Branch::pluck('name', 'id');
@endphp


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
                                                <th>@lang('lang.store')</th>
                                                <th>@lang('lang.added_by')</th>
                                                <th>@lang('lang.updated_by')</th>
                                                <th>@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($stores as $index => $store)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $store->name }}</td>
                                                    <td>{{ $store->store->name ?? 'NAN' }}</td>
                                                    <td>
                                                        @if ($store->created_by > 0 and $store->created_by != null)
                                                            {{ $store->created_at->diffForHumans() }} <br>
                                                            {{ $store->created_at->format('Y-m-d') }}
                                                            ({{ $store->created_at->format('h:i') }})
                                                            {{ $store->createBy?->name }}
                                                        @else
                                                            {{ __('no_update') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($store->edited_by > 0 and $store->edited_by != null)
                                                            {{ $store->updated_at->diffForHumans() }} <br>
                                                            {{ $store->updated_at->format('Y-m-d') }}
                                                            ({{ $store->updated_at->format('h:i') }})
                                                            {{ $store->updated_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $store->updateBy?->name }}
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
                                                                    <button
                                                                        onclick="toggleEditModal({{ $nationality->id }})"><i
                                                                            class="dripicons-document-edit"></i>
                                                                        @lang('lang.update')</button>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <a data-href="{{ route('stores.destroy', $store->id) }}"
                                                                        class=" delete_item"><i class="fa fa-trash"></i>
                                                                        @lang('lang.delete')</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @include('store_categories.edit')
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
