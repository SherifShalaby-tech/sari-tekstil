@extends('layouts.app')
@section('title', __('lang.attendance'))

@section('page_title')
    {{ __('lang.attendance') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.attendance')</a></li>
@endsection
@if (auth()->user()->can('employees_module.attendance.create'))

    @section('button')
        <a class="button" href="{{ route('attendance.create') }}">
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
                                                <th>@lang('lang.date')</th>
                                                <th>@lang('lang.name')</th>
                                                <th>@lang('lang.check_in_time')</th>
                                                <th>@lang('lang.check_out_time')</th>
                                                <th>@lang('lang.status')</th>
                                                <th>@lang('lang.added_by')</th>
                                                <th>@lang('lang.updated_by')</th>
                                                <th>@lang('lang.action')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($attendances as $index => $attendance)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        {{ @format_date($attendance->date) }}
                                                    </td>
                                                    <td>
                                                        {{ $attendance->employee->name }}
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($attendance->check_in)->format('h:i:s A') }}
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($attendance->check_out)->format('h:i:s A') }}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge @attendance_status($attendance->status)">{{ __('lang.' . $attendance->status) }}</span>
                                                        @if ($attendance->status == 'late')
                                                            @php
                                                                $check_in_data = [];
                                                                $employee = App\Models\Employee::find(
                                                                    $attendance->employee_id,
                                                                );
                                                                if (!empty($employee)) {
                                                                    $check_in_data = $employee->check_in;
                                                                }
                                                                $day_name = Illuminate\Support\Str::lower(
                                                                    \Carbon\Carbon::parse($attendance->date)->format(
                                                                        'l',
                                                                    ),
                                                                );
                                                                $late_time = 0;
                                                                if (!empty($check_in_data[$day_name])) {
                                                                    $check_in_time = $check_in_data[$day_name];
                                                                    $late_time = \Carbon\Carbon::parse(
                                                                        $attendance->check_in,
                                                                    )->diffInMinutes($check_in_time);
                                                                }
                                                            @endphp
                                                            @if ($late_time > 0)
                                                                +{{ $late_time }}
                                                            @endif
                                                        @endif
                                                        {{-- @if ($attendance->status == 'on_leave')
                                    @php
                                    $leave = App\Models\NumberOfLeave::leftjoin('leave_types', 'leave_type_id',
                                    'leave_types.id')
                                    ->where('employee_id', $attendance->employee_id)
                                    ->where('start_date', '>=', $attendance->date)
                                    ->where('start_date', '<=', $attendance->date)
                                        ->select('leave_types.name')
                                        ->first()
                                        @endphp
                                        @if (!empty($leave))
                                        {{$leave->name}}
                                        @endif
                                        @endif --}}
                                                    </td>
                                                    <td>
                                                        @if ($attendance->created_by > 0 and $attendance->created_by != null)
                                                            {{ $attendance->created_at->diffForHumans() }} <br>
                                                            {{ $attendance->created_at->format('Y-m-d') }}
                                                            ({{ $attendance->created_at->format('h:i') }})
                                                            {{ $attendance->created_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $attendance->createBy?->name }}
                                                        @else
                                                            {{ __('no_update') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($attendance->edited_by > 0 and $attendance->edited_by != null)
                                                            {{ $attendance->updated_at->diffForHumans() }} <br>
                                                            {{ $attendance->updated_at->format('Y-m-d') }}
                                                            ({{ $attendance->updated_at->format('h:i') }})
                                                            {{ $attendance->updated_at->format('A') == 'AM' ? __('am') : __('pm') }}
                                                            <br>
                                                            {{ $attendance->updateBy?->name }}
                                                        @else
                                                            {{ __('no_update') }}
                                                        @endif
                                                    </td>
                                                    @if (auth()->user()->can('employees_module.attendance.delete'))
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
                                                                    <li> <a data-href="{{ route('attendance.destroy', $attendance->id) }}"
                                                                            class=" delete_item"><i class="fa fa-trash"></i>
                                                                            @lang('lang.delete')</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    @endif
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
