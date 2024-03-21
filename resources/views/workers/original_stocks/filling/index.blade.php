@extends('layouts.app')
@section('title', __('lang.filling'))

@section('page_title')
    {{ __('lang.filling') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.filling')</a></li>
@endsection

@if (auth()->user()->can('orignal_store_worker'))
    @section('button')
        <a class="button" href="{{ route('original-store-worker-filling.create') }}">
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
            <div class="col-lg-12 ">
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
                                                <th>@lang('lang.sku')</th>
                                                <th>@lang('lang.type')</th>
                                                <th>@lang('lang.net_weight')</th>
                                                <th>@lang('lang.batch_number')</th>
                                                <th>@lang('lang.process')</th>
                                                <th>@lang('lang.workers')</th>
                                                <th>@lang('lang.nationalities')</th>
                                                <th>@lang('lang.percent')</th>
                                                <th>@lang('lang.actual_weight')</th>
                                                <th>@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($fillings as $index => $fill)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $fill->car->sku }}</td>
                                                    <td>{{ $fill->type->name }}</td>
                                                    <td>{{ $fill->net_weight }}</td>
                                                    <td>{{ $fill->car->batch_number ?? '-' }}</td>
                                                    <td>{{ $fill->process }}</td>
                                                    <td>
                                                        @if (!empty($fill->workers))
                                                            @for ($i = 0; $i < count($fill->workers); $i++)
                                                                {{ \App\Models\Employee::find($fill->workers[$i])->name }}<br>
                                                            @endfor
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @foreach ($fill->car_contents as $content)
                                                            {{ $content->nationality->name }} <br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($fill->car_contents as $content)
                                                            {{ $content->percentage ?? 0 }} % <br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($fill->car_contents as $content)
                                                            {{ $content->goods_weight ?? 0 }} <br>
                                                        @endforeach
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
                                                                @if (auth()->user()->can('orignal_store_worker'))
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('original-store-worker-filling.edit', $fill->id) }}"><i
                                                                                class="dripicons-document-edit"></i>
                                                                            @lang('lang.update')</a>
                                                                    </li>
                                                                @endif
                                                                <li class="divider"></li>
                                                                @if (auth()->user()->can('orignal_store_worker'))
                                                                    <li>
                                                                        <a data-href="{{ route('original-store-worker-filling.destroy', $fill->id) }}"
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
