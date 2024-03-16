@extends('layouts.app')
@section('title', __('lang.add_employees'))

@section('page_title')
    E-Commerce
@endsection

@section('breadcrumbs')
    @parent
    <li><a href="{{ route('employees.index') }}">{{ __('lang.employees') }}</a>
    </li>
    <li class="last active"><a href="#">@lang('lang.add_employees')</a></li>
@endsection


@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                {!! Form::open([
                    'route' => 'employees.store',
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                ]) !!}
                <div class="card  p-2 mb-2">
                    <div class="row">
                        <div class="col-md-3 px-4 mb-3">
                            {!! Form::label('branch_name', __('lang.branch_name'), ['class' => 'form-label']) !!}
                            {!! Form::select('branch_id', $branches, null, [
                                'class' => 'form-control required',
                                'placeholder' => __('lang.please_select'),
                                'id' => 'brand_id',
                            ]) !!}
                        </div>
                        <div class="col-md-3 d-flex align-items-end px-4 mb-3">
                            <div class="form__group">
                                {!! Form::text('name', null, [
                                    'class' => 'form__field required',
                                    'placeholder' => __('lang.name'),
                                ]) !!}
                                {!! Form::label('name', __('lang.name'), ['class' => 'form__label']) !!}
                                @error('name')
                                    <label class="text-danger error-msg">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 d-flex align-items-end px-4 mb-3">
                            <div class="form__group">
                                {!! Form::email('email', null, [
                                    'class' => 'form__field required',
                                    'placeholder' => __('lang.email'),
                                ]) !!}
                                {!! Form::label('email', __('lang.email'), ['class' => 'form__label']) !!}
                                @error('email')
                                    <label class="text-danger error-msg">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 d-flex align-items-end px-4 mb-3">
                            <div class="form__group">
                                {!! Form::text('phone', null, [
                                    'id' => 'inputmask-phone',
                                    'class' => 'form__field',
                                    'placeholder' => __('lang.phone'),
                                ]) !!}
                                {!! Form::label('phone', __('lang.phone'), ['class' => 'form__label']) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-4 mb-3">
                            {!! Form::label('job_type', __('lang.job_type'), ['class' => 'form-label']) !!}
                            {!! Form::select(
                                'job_type_id',
                                $jobs->map(function ($title, $id) {
                                    $translatedTitle = trans('lang.' . $title);
                                    return strpos($translatedTitle, 'lang.') === 0 ? $title : $translatedTitle;
                                }),
                                null,
                                ['class' => 'form-control required', 'placeholder' => __('lang.please_select'), 'id' => 'brand_id'],
                            ) !!}
                        </div>
                        <div class="col-md-3 d-flex align-items-end px-4 mb-3">
                            <div class="form__group">
                                {!! Form::number('daily_limit_of_daily_production', null, [
                                    'class' => 'form__field required',
                                    'placeholder' => __('lang.daily_limit_of_daily_production'),
                                ]) !!}
                                {!! Form::label('daily_limit_of_daily_production', __('lang.daily_limit_of_daily_production'), [
                                    'class' => 'form__label',
                                ]) !!}
                            </div>
                        </div>

                        <div class="col-md-3 d-flex align-items-end px-4 mb-3">
                            <div class="form__group">
                                <input type="password" class="form__field" name="password" id="inputPassword"
                                    placeholder="{{ __('lang.password') }}">
                                {!! Form::label('password', __('lang.password'), ['class' => 'form__label']) !!}
                                @error('password')
                                    <label class="text-danger error-msg">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end px-4 mb-3">
                            <div class="form__group">
                                <input type="password" class="form__field" name="password_confirmation" id="inputPassword"
                                    placeholder="{{ __('lang.confirm_password') }}">
                                {!! Form::label('confirm_password', __('lang.confirm_password'), ['class' => 'form__label']) !!}
                            </div>
                        </div>
                        <div class="col-md-3 px-4 mb-3">
                            {!! Form::label('date_of_start_working', __('lang.date_of_start_working'), ['class' => 'form-label']) !!}
                            {!! Form::date('date_of_start_working', null, [
                                'class' => 'form-control',
                                'placeholder' => __('lang.date_of_start_working'),
                            ]) !!}
                        </div>
                        <div class="col-md-3 px-4 mb-3">
                            {!! Form::label('date_of_birth', __('lang.date_of_birth'), ['class' => 'form-label']) !!}
                            {!! Form::date('date_of_birth', null, [
                                'class' => 'form-control',
                                'placeholder' => __('lang.date_of_birth'),
                            ]) !!}
                        </div>

                        <div class="col-md-3 px-4 mb-3">
                            {!! Form::label('upload_files', __('lang.upload_files'), ['class' => 'form-label']) !!}
                            {{-- {!! Form::file('upload_files[]', null, [
                                'class' => 'form-control',
                                'multiple'=>'multiple',
                                'placeholder'=>__('lang.upload_files')
                            ]) !!} --}}
                            <input type="file" name="upload_files[]" multiple>
                        </div>
                        <div class="col-md-3 px-4 mb-3">
                            {!! Form::label('photo', __('lang.profile_photo'), ['class' => 'form-label']) !!}
                            {!! Form::file('photo', null, [
                                'class' => 'form-control',
                                'placeholder' => __('lang.profile_photo'),
                            ]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <button type="button" class="px-3 py-2 print-button" data-toggle="modal"
                                data-target="#salary_details">
                                <span class="transition"></span>
                                <span class="gradient"></span>
                                <span class="label"> @lang('lang.salary_details')
                                </span>
                            </button>
                            <!-- Button salary modal -->
                            {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#salary_details">
                                @lang('lang.salary_details')
                            </button> --}}
                        </div>

                        @include('employees.salary_details')
                    </div>

                    <div class="row">
                        @foreach ($leave_types as $leave_type)
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="i-checks">
                                        <input id="number_of_leaves{{ $leave_type->id }}"
                                            name="number_of_leaves[{{ $leave_type->id }}][enabled]" type="checkbox"
                                            value="1" class="form-control-custom">
                                        <label
                                            for="number_of_leaves{{ $leave_type->id }}"><strong>{{ $leave_type->name }}</strong></label>
                                        <input type="number" class="form-control"
                                            name="number_of_leaves[{{ $leave_type->id }}][number_of_days]"
                                            id="number_of_leaves" placeholder="{{ $leave_type->name }}" readonly
                                            value="{{ $leave_type->number_of_days_per_year }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-5">
                                    <button type="button" class="px-3 py-2 print-button" data-bs-toggle="collapse"
                                        data-bs-target="#workingDaysPerWeekcollapse" aria-expanded="false"
                                        aria-controls="workingDaysPerWeekcollapse">
                                        <span class="transition"></span>
                                        <span class="gradient"></span>
                                        <span class="label">@lang('lang.select_working_day_per_week')</span>
                                    </button>
                                </div>
                                {{-- <div class="col-md-5 mb-3">
                                    <h4>@lang('lang.select_working_day_per_week')</h4>
                                </div> --}}
                            </div>
                            <div class="collapse" id="workingDaysPerWeekcollapse">
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
                                                                name="working_day_per_week[{{ $key }}]"
                                                                type="checkbox" value="1" class="form-control-custom">
                                                            <label
                                                                for="working_day_per_week{{ $key }}"><strong>{{ $week_day }}</strong></label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {!! Form::time('check_in[' . $key . ']', null, ['class' => 'form-control input-md check_in time_picker']) !!}
                                                </td>
                                                <td>
                                                    {!! Form::time('check_out[' . $key . ']', null, ['class' => 'form-control input-md check_out time_picker']) !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-5">
                                    <button type="button" class="px-3 py-2 print-button" data-bs-toggle="collapse"
                                        data-bs-target="#userPermissionCollapse" aria-expanded="false"
                                        aria-controls="userPermissionCollapse">
                                        <span class="transition"></span>
                                        <span class="gradient"></span>
                                        <span class="label">@lang('lang.user_rights')</span>
                                    </button>
                                </div>
                            </div>
                            <div class="collapse" id="userPermissionCollapse">
                                <div class="col-md-12">
                                    @include('employees.permission')
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <button type="submit" class="px-3 py-2 submit-button">
                                <span class="transition"></span>
                                <span class="gradient"></span>
                                <span class="label">@lang('lang.save')</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
@endsection
@push('javascripts')
    <script src="{{ asset('app-js/employee.js') }}"></script>

    <script>
        $(document).ready(function() {
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
    <script src="{{ asset('front/bootstrap.min.js') }}"></script>
@endpush
