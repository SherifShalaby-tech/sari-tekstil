@extends('layouts.app')
@section('title', __('lang.branches'))


@section('page_title')
    {{ __('lang.E-Commerce') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.branches')</a></li>
    @include('branches.create')
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

    {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#createBranchModal"><i
            class="ri-add-line align-middle mr-2"></i>Add</button> --}}
@endsection

@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12 ">
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
                                            @foreach ($branches as $index => $branch)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $branch->name }}</td>
                                                    <td>{{ $branch->phone_number ?? 'NAN' }}</td>
                                                    <td>{{ $branch->email ?? 'NAN' }}</td>
                                                    <td>{{ $branch->manager_name ?? 'NAN' }}</td>
                                                    <td>{{ $branch->location ?? 'NAN' }}</td>
                                                    <td>
                                                        @if ($branch->created_by > 0 and $branch->created_by != null)
                                                            {{ $branch->created_at->diffForHumans() }} <br>
                                                            {{ $branch->created_at->format('Y-m-d') }}
                                                            ({{ $branch->created_at->format('h:i') }})
                                                            {{ $branch->created_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $branch->createBy?->name }}
                                                        @else
                                                            {{ __('no_update') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($branch->edited_by > 0 and $branch->edited_by != null)
                                                            {{ $branch->updated_at->diffForHumans() }} <br>
                                                            {{ $branch->updated_at->format('Y-m-d') }}
                                                            ({{ $branch->updated_at->format('h:i') }})
                                                            {{ $branch->updated_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $branch->updateBy?->name }}
                                                        @else
                                                            {{ __('no_update') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class=" cd-dropdown-wrapper">
                                                            <button type="button"
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
                                                                        onclick="toggleEditModal({{ $branch->id }})"><i
                                                                            class="dripicons-document-edit"></i>
                                                                        @lang('lang.update')</button>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <a data-href="{{ route('branches.destroy', $branch->id) }}"
                                                                        class=" delete_item"><i class="fa fa-trash"></i>
                                                                        @lang('lang.delete')</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @include('branches.edit')
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
