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
    <button class="btn btn-primary" data-toggle="modal" data-target="#createJobModal"><i
            class="ri-add-line align-middle mr-2"></i>@lang('lang.add')</button>
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
                                            {{ $lab->created_at->format('A') == 'AM' ? __('am') : __('pm') }} <br>
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
                                            {{ $lab->updated_at->format('A') == 'AM' ? __('am') : __('pm') }} <br>
                                            {{ $lab->updateBy?->name }}
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
                                                    <a data-href="{{ route('lab.edit', $lab->id) }}"
                                                        data-container=".view_modal" class="btn btn-modal"
                                                        data-toggle="modal"><i class="dripicons-document-edit"></i>
                                                        @lang('lang.update')</a>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a data-href="{{ route('lab.destroy', $lab->id) }}"
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
