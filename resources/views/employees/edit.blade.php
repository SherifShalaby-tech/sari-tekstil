@extends('layouts.app')
@section('title', __('lang.edit_employees'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->                    
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">E-Commerce</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item"><a href="{{route('employees.index')}}">{{__('lang.employees')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.edit_employees')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>          
    </div>
@endsection
@section('content')
    <!-- Start Contentbar -->    
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12 col-xl-12">
                <div class="card m-b-30 p-2">
                     {!! Form::open(['route' => ['employees.update',$employee->id],'method'=>'put','id'=>'color-update-form' , 'enctype' => 'multipart/form-data',]) !!}
                     @csrf
                     @method('PUT')
                    <div class="row">               
                        <div class="col-md-3">
                            {!! Form::label('branch_name', __('lang.branch_name'), ['class'=>'h6 pt-3']) !!}
                                {!! Form::select(
                                    'branch_id',
                                    $branches,$employee->branch_id,
                                    ['class' => 'form-control required','placeholder'=>__('lang.please_select'),'id'=>'brand_id']
                            ) !!}
                        </div>
                        <div class="col-md-3">
                        <input type="hidden" value="{{$employee->user_id}}" name="user_id"/>
                            {!! Form::label('name', __('lang.name'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('name', $employee->name, [
                                'class' => 'form-control required',
                                'placeholder'=>__('lang.name'),
                                $employee->name == 'Admin'?'readonly':''
                            ]) !!}
                            @error('name')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            {!! Form::label('email', __('lang.email'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::email('email', $employee->user->email, [
                                'class' => 'form-control required',
                                'placeholder'=>__('lang.email')
                            ]) !!}
                            @error('email')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            {!! Form::label('phone', __('lang.phone'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::text('phone', $employee->phone, [
                                'id'=>"inputmask-phone",
                                'class' => 'form-control',
                                'placeholder'=>__('lang.phone')
                            ]) !!}
                        </div>                       
                        <div class="col-md-3">
                            {!! Form::label('job_type', __('lang.job_type'), ['class'=>'h6 pt-3']) !!}
                                {!! Form::select(
                                    'job_type_id',
                                    $jobs,$employee->job_type_id,
                                    ['class' => 'form-control required','placeholder'=>__('lang.please_select'),'id'=>'brand_id']
                            ) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('daily_limit_of_daily_production', __('lang.daily_limit_of_daily_production'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::number('daily_limit_of_daily_production', $employee->daily_limit_of_daily_production, [
                                'class' => 'form-control required',
                                'placeholder'=>__('lang.daily_limit_of_daily_production')
                            ]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            {!! Form::label('password', __('lang.password'), ['class'=>'h6 pt-3']) !!}
                            <input type="password" class="form-control" value="{{$employee->password}}" name="password" id="inputPassword" placeholder="{{__('lang.password')}}">
                            @error('password')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('confirm_password', __('lang.confirm_password'), ['class'=>'h6 pt-3']) !!}
                            <input type="password" class="form-control"value="{{$employee->password}}"  name="password_confirmation" id="inputPassword" placeholder="{{__('lang.confirm_password')}}">
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('date_of_start_working', __('lang.date_of_start_working'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::date('date_of_start_working', $employee->date_of_start_working, [
                                'class' => 'form-control',
                                'placeholder'=>__('lang.date_of_start_working')
                            ]) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('date_of_birth', __('lang.date_of_birth'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::date('date_of_birth', $employee->date_of_birth, [
                                'class' => 'form-control',
                                'placeholder'=>__('lang.date_of_birth')
                            ]) !!}
                        </div>

                        <div class="col-md-3">
                            {!! Form::label('upload_files', __('lang.upload_files'), ['class'=>'h6 pt-3']) !!}
                             <input type="file" name="upload_files[]"  multiple>
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('photo', __('lang.profile_photo'), ['class'=>'h6 pt-3']) !!}
                            {!! Form::file('photo', null, [
                                'class' => 'form-control',
                                'placeholder'=>__('lang.profile_photo')
                            ]) !!}
                        </div>
                    </div>
                    <div class="row mt-4">
                        <!-- Button salary modal -->
                        <button type="button" style="margin-left: 15px;" class="btn btn-primary"
                                data-toggle="modal" data-target="#salary_details">
                            @lang('lang.salary_details')
                        </button>
                        @include('employees.salary_details')
                    </div>
                    
                    <div class="row mt-4">
                        @foreach ($leave_types as $leave_type)
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="i-checks">
                                        <input id="number_of_leaves{{ $leave_type->id }}"
                                               name="number_of_leaves[{{ $leave_type->id }}][enabled]"
                                               type="checkbox" value="1" class="form-control-custom">
                                        <label
                                            for="number_of_leaves{{ $leave_type->id }}"><strong>{{ $leave_type->name }}</strong></label>
                                        <input type="number" class="form-control"
                                               name="number_of_leaves[{{ $leave_type->id }}][number_of_days]"
                                               id="number_of_leaves" placeholder="{{ $leave_type->name }}"
                                               readonly value="{{ $leave_type->number_of_days_per_year }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label
                                for="working_day_per_week">@lang('lang.select_working_day_per_week')</label>
                            <table>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>@lang('lang.check_in')</th>
                                    <th> @lang('lang.check_out')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($week_days as $key => $week_day)
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <div class="i-checks">
                                                    <input id="working_day_per_week{{ $key }}"
                                                    @if (!empty($employee->working_day_per_week[$key])) checked @endif
                                                           name="working_day_per_week[{{ $key }}]"
                                                           type="checkbox" value="1"
                                                           class="form-control-custom">
                                                    <label
                                                        for="working_day_per_week{{ $key }}"><strong>{{ $week_day }}</strong></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {!! Form::time('check_in[' . $key . ']', !empty($employee->check_in[$key]) ? $employee->check_in[$key] : null, ['class' => 'form-control input-md check_in time_picker',]) !!}
                                        </td>
                                        <td>
                                            {!! Form::time('check_out[' . $key . ']', !empty($employee->check_out[$key]) ? $employee->check_out[$key] : null, ['class' => 'form-control input-md check_out time_picker',]) !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12 text-center">
                            <h3>@lang('lang.user_rights')</h3>
                        </div>
                        <div class="col-md-12">
                            @include('employees.permission')
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-md-3 pt-5">
                            <button type="submit" class="btn btn-primary ">@lang('lang.save')</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
@push('javascripts')
<script src="{{asset('app-js/employee.js')}}" ></script>

<script>
    $( document ).ready(function() {
        $('.checked_all').change(function() {
            tr = $(this).closest('tr');
            var checked_all = $(this).prop('checked');

            tr.find('.check_box').each(function(item) {
                if (checked_all === true) {
                    $(this).prop('checked', true)
                } else {
                    $(this).prop('checked', false)
                }
            })
        })
        $('.all_module_check_all').change(function() {
            var all_module_check_all = $(this).prop('checked');
            $('#permission_table > tbody > tr').each((i, tr) => {
                $(tr).find('.check_box').each(function(item) {
                    if (all_module_check_all === true) {
                        $(this).prop('checked', true)
                    } else {
                        $(this).prop('checked', false)
                    }
                })
                $(tr).find('.module_check_all').each(function(item) {
                    if (all_module_check_all === true) {
                        $(this).prop('checked', true)
                    } else {
                        $(this).prop('checked', false)
                    }
                })
                $(tr).find('.checked_all').each(function(item) {
                    if (all_module_check_all === true) {
                        $(this).prop('checked', true)
                    } else {
                        $(this).prop('checked', false)
                    }
                })

            })
        })
        $('.module_check_all').change(function() {
            let moudle_id = $(this).closest('tr').data('moudle');
            if ($(this).prop('checked')) {
                $('.sub_module_permission_' + moudle_id).find('.checked_all').prop('checked', true);
                $('.sub_module_permission_' + moudle_id).find('.check_box').prop('checked', true);
            } else {
                $('.sub_module_permission_' + moudle_id).find('.checked_all').prop('checked', false);
                $('.sub_module_permission_' + moudle_id).find('.check_box').prop('checked', false);
            }
        })
        $(document).on('change', '.view_check_all', function() {
            if ($(this).prop('checked')) {
                $('.check_box_view').prop('checked', true);
            } else {
                $('.check_box_view').prop('checked', false);
            }
        });
        $(document).on('change', '.create_check_all', function() {
            if ($(this).prop('checked')) {
                $('.check_box_create').prop('checked', true);
            } else {
                $('.check_box_create').prop('checked', false);
            }
        });
        $(document).on('change', '.delete_check_all', function() {
            if ($(this).prop('checked')) {
                $('.check_box_delete').prop('checked', true);
            } else {
                $('.check_box_delete').prop('checked', false);
            }
        });

        $(document).on('focusout', '.check_in', function() {
            $('.check_in').val($(this).val())
        })
        $(document).on('focusout', '.check_out', function() {
            $('.check_out').val($(this).val())
        })
    });
</script>
@endpush