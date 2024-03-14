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
                <div class="card p-2 mb-2">

                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
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
                                                {{ $store->updated_at->format('A') == 'AM' ? __('am') : __('pm') }} <br>
                                                {{ $store->updateBy?->name }}
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
                                                        <button onclick="toggleEditModal({{ $nationality->id }})"><i
                                                                class="dripicons-document-edit"></i>
                                                            @lang('lang.update')</button>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li>
                                                        <a data-href="{{ route('stores.destroy', $store->id) }}"
                                                            class="btn text-red delete_item"><i class="fa fa-trash"></i>
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
    <!-- End Contentbar -->
@endsection
