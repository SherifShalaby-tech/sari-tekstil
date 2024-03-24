@extends('layouts.app')
@section('title', __('lang.filling_admin_requests'))

@section('page_title')
    {{ __('lang.filling_admin_requests') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.filling_admin_requests')</a></li>
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

                                                <th>@lang('lang.ids')</th>
                                                <th>@lang('lang.source')</th>
                                                <th>@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($fillingrequests as $index => $request)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $request->id }}</td>
                                                    <td>{{ $request->source }}</td>
                                                    <td>
                                                        @if (auth()->user()->can('orignal_store_worker'))
                                                            <a href="{{ route('filling-admin-requests.edit', $request->id) }}"
                                                                class="btn btn-primary"><i
                                                                    class="dripicons-document-edit"></i>
                                                                @lang('lang.update')</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- End col -->
                        </div>
                        <!-- End row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contentbar -->
@endsection
