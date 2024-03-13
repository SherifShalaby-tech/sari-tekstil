@extends('layouts.app')
@section('title', __('lang.suppliers'))




@section('page_title')
    {{ __('lang.suppliers') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.suppliers')</a></li>
@endsection

@if (auth()->user()->can('suppliers_module.supplier.create'))

    @section('button')
        <a class="button" href="{{ route('suppliers.create') }}">
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
            <div class="col-lg-12 col-xl-12">
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('lang.name')</th>
                                <th>@lang('lang.responsable_name')</th>
                                <th>@lang('lang.email')</th>
                                <th>@lang('lang.phone_numbers')</th>
                                <th>@lang('lang.country')</th>
                                <th>@lang('lang.currency')</th>
                                <th>@lang('lang.total_purchases')</th>
                                <th>@lang('lang.total_debt')</th>
                                <th>@lang('lang.bank_name')</th>
                                <th>@lang('lang.address')</th>
                                <th>@lang('lang.added_by')</th>
                                <th>@lang('lang.updated_by')</th>
                                <th>@lang('lang.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $index => $supplier)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->user->name }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>
                                        @if (!isset($supplier->phones))
                                            {{ $supplier->phones[0] }}<br>
                                            {{ $supplier->phones[1] }}<br>
                                            {{ $supplier->phones[2] }}
                                        @endif
                                    </td>
                                    <td>{{ $supplier->country }}</td>
                                    <td>{{ $supplier->currency->currency }}</td>
                                    <td>{{ $supplier->total_purchases ?? 0 }}</td>
                                    <td>{{ $supplier->total_debt ?? 0 }}</td>
                                    <td>{{ $supplier->bank_name }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td>
                                        @if ($supplier->created_by > 0 and $supplier->created_by != null)
                                            {{ $supplier->created_at->diffForHumans() }} <br>
                                            {{ $supplier->created_at->format('Y-m-d') }}
                                            ({{ $supplier->created_at->format('h:i') }})
                                            {{ $supplier->created_at->format('A') == 'AM' ? __('am') : __('pm') }} <br>
                                            {{ $supplier->createBy?->name }}
                                        @else
                                            {{ __('no_update') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($supplier->edited_by > 0 and $supplier->edited_by != null)
                                            {{ $supplier->updated_at->diffForHumans() }} <br>
                                            {{ $supplier->updated_at->format('Y-m-d') }}
                                            ({{ $supplier->updated_at->format('h:i') }})
                                            {{ $supplier->updated_at->format('A') == 'AM' ? __('am') : __('pm') }} <br>
                                            {{ $supplier->updateBy?->name }}
                                        @else
                                            {{ __('no_update') }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button supplier="button" class="btn btn-default btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">خيارات
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default"
                                                user="menu" x-placement="bottom-end"
                                                style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                @if (auth()->user()->can('suppliers_module.supplier.edit'))
                                                    <li>
                                                        <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                                            class="btn"><i class="dripicons-document-edit"></i>
                                                            @lang('lang.update')</a>
                                                    </li>
                                                @endif
                                                <li class="divider"></li>
                                                @if (auth()->user()->can('suppliers_module.supplier.delete'))
                                                    <li>
                                                        <a data-href="{{ route('suppliers.destroy', $supplier->id) }}"
                                                            class="btn text-red delete_item"><i class="fa fa-trash"></i>
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
    <!-- End Contentbar -->
@endsection
