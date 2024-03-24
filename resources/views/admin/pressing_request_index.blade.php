@extends('layouts.app')
@section('title', __('lang.pressing'))

@section('page_title')
    {{ __('lang.pressing_requests') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.pressing_requests')</a></li>
@endsection

@section('button')
    <a class="button" href="{{ route('pressing-admin-requests.create') }}">
        <div class="button-wrapper">
            <div class="text">@lang('lang.add')</div>
            <span class="icon">
                <i class="fas fa-plus text-white"></i>
            </span>
        </div>
    </a>
@endsection


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
                                                <th>@lang('lang.source')</th>
                                                <th>@lang('lang.priority')</th>
                                                <th>@lang('lang.filling')</th>
                                                <th>@lang('lang.requested_weight')</th>
                                                <th>@lang('lang.calibers')</th>
                                                <th>@lang('lang.screening')</th>
                                                <th>@lang('lang.destination')</th>
                                                {{-- <th>@lang('lang.employee')</th> --}}
                                                <th>@lang('lang.color')</th>
                                                <th>@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pressing_request_transactions as $index => $pressingRequestTransaction)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $pressingRequestTransaction->source }}</td>
                                                    <td>{{ $pressingRequestTransaction->priority }}</td>
                                                    <td>
                                                        @foreach ($pressingRequestTransaction->pressing_requests as $index => $pressingRequest)
                                                            {{ $pressingRequest->filling->name ?? '' }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($pressingRequestTransaction->pressing_requests as $index => $pressingRequest)
                                                            {{ $pressingRequest->weight }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($pressingRequestTransaction->pressing_requests as $index => $pressingRequest)
                                                            @php
                                                                $calibersString = implode(
                                                                    ', ',
                                                                    $pressingRequest->calibers,
                                                                );
                                                            @endphp
                                                            {{ $calibersString }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($pressingRequestTransaction->pressing_requests as $index => $pressingRequest)
                                                            {{ $pressingRequest->screening->name }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($pressingRequestTransaction->pressing_requests as $index => $pressingRequest)
                                                            {{ $pressingRequest->destination }}<br>
                                                        @endforeach
                                                    </td>
                                                    {{-- <td>{{$fillingRequest->employee->name ??"-"}}</td> --}}
                                                    <td>
                                                        @foreach ($pressingRequestTransaction->pressing_requests as $index => $pressingRequest)
                                                            {{ $pressingRequest->color->name ?? '-' }}<br>
                                                        @endforeach
                                                    </td>
                                                    {{-- @endforeach --}}
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
                                                                    <a data-href="{{ route('pressing-admin-requests.destroy', $pressingRequestTransaction->id) }}"
                                                                        class="delete_item"><i class="fa fa-trash"></i>
                                                                        @lang('lang.delete')</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <a
                                                                        href="{{ route('pressing-admin-requests.edit', $pressingRequestTransaction->id) }}"><i
                                                                            class="dripicons-document-edit"></i>
                                                                        @lang('lang.update')</a>
                                                                </li>
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
