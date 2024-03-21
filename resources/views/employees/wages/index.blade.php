@extends('layouts.app')
@section('title', __('lang.wages'))

@section('page_title')
    {{ __('lang.wages') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.wages')</a></li>
@endsection

@if (auth()->user()->can('employees_module.wages.create'))
    @section('button')
        <a class="button" href="{{ route('wages.create') }}">
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
                                                <th>@lang('lang.date_of_creation')</th>
                                                <th>@lang('lang.name')</th>
                                                <th>@lang('lang.account_period')</th>
                                                <th>@lang('lang.job_title')</th>
                                                <th>@lang('lang.amount_paid')</th>
                                                <th>@lang('lang.type_of_payment')</th>
                                                <th>@lang('lang.date_of_payment')</th>
                                                <th>@lang('lang.paid_by')</th>
                                                <th>@lang('lang.status')</th>
                                                <th>@lang('lang.added_by')</th>
                                                <th>@lang('lang.updated_by')</th>
                                                <th>@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($wages as $index => $wage)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $wage->date_of_creation }}</td>
                                                    <td>{{ $wage->employee->name }}</td>
                                                    <td>
                                                        @if ($wage->payment_type == 'salary')
                                                            {{ \Carbon\Carbon::parse($wage->account_period)->format('F') }}
                                                        @else
                                                            @if (!empty($wage->acount_period_start_date))
                                                                {{ @format_date($wage->acount_period_start_date) }}
                                                            @endif
                                                            -
                                                            @if (!empty($wage->acount_period_end_date))
                                                                {{ @format_date($wage->acount_period_end_date) }}
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>{{ $wage->employee->job_type->title }}</td>
                                                    <td>
                                                        {{-- {{ $settings['currency'] }} --}}
                                                        {{ @num_format($wage->net_amount) }}
                                                    </td>
                                                    <td>
                                                        @if (!empty($payment_types[$wage->payment_type]))
                                                            {{ $payment_types[$wage->payment_type] }}
                                                        @endif
                                                    </td>
                                                    <td>{{ @format_date($wage->payment_date) }}</td>
                                                    <td>
                                                        @if (!empty($wage->wage_transaction))
                                                            {{ $wage->wage_transaction->source->name }}
                                                        @endif
                                                    </td>
                                                    <td>{{ ucfirst($wage->status) }}</td>
                                                    <td>
                                                        @if ($wage->created_by > 0 and $wage->created_by != null)
                                                            {{ $wage->created_at->diffForHumans() }} <br>
                                                            {{ $wage->created_at->format('Y-m-d') }}
                                                            ({{ $wage->created_at->format('h:i') }})
                                                            {{ $wage->created_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $wage->createBy?->name }}
                                                        @else
                                                            {{ __('no_update') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($wage->edited_by > 0 and $wage->edited_by != null)
                                                            {{ $wage->updated_at->diffForHumans() }} <br>
                                                            {{ $wage->updated_at->format('Y-m-d') }}
                                                            ({{ $wage->updated_at->format('h:i') }})
                                                            {{ $wage->updated_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $wage->updateBy?->name }}
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
                                                                @if (auth()->user()->can('employees_module.wages.edit'))
                                                                    <li>
                                                                        <a
                                                                            href="{{ route('wages.changeWageStatus', $wage->id) }}">@lang('lang.paid')</a>
                                                                    </li>
                                                                @endif
                                                                @if (auth()->user()->can('employees_module.wages.edit'))
                                                                    <li>
                                                                        <a href="{{ route('wages.edit', $wage->id) }}"><i
                                                                                class="dripicons-document-edit"></i>
                                                                            @lang('lang.update')</a>
                                                                    </li>
                                                                @endif
                                                                <li class="divider"></li>
                                                                @if (auth()->user()->can('employees_module.wages.delete'))
                                                                    <li>
                                                                        <a data-href="{{ route('wages.destroy', $wage->id) }}"
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
