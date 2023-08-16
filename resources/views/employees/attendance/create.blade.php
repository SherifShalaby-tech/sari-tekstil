@extends('layouts.app')
@section('title', __('lang.add_attendance'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->                    
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">@lang('lang.attendance')</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item"><a href="{{route('attendance.index')}}">{{__('lang.attendance')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.add_attendance')</li>
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
                    {!! Form::open([
                        'route' => 'attendance.store',
                        'method' => 'post'
                    ]) !!}
                      <input type="hidden" name="index" id="index" value="0">
                      <div class="row">
                          <div class="col-md-12">
                              <button type="button" class="btn btn-primary add_row" id="add_row">+
                                  @lang('lang.add_row')</button>
                          </div>
                      </div>
                      <br>
                      <table class="table" id="attendance_table">
                          <thead>
                              <tr>
                                  <th>@lang('lang.date')</th>
                                  <th>@lang('lang.name')</th>
                                  <th>@lang('lang.checkin')</th>
                                  <th>@lang('lang.checkout')</th>
                                  <th>@lang('lang.status')</th>
                                  <th>@lang('lang.added_by')</th>
                              </tr>
                          </thead>

                          <tbody>

                              <tr>
                                  <td><input type="date" class="form-control date" name="attendances[0][date]"
                                          required></td>
                                  <td>
                                      {!! Form::select('attendances[0][employee_id]', $employees, null , ['class'
                                      => 'form-control selectpicker', 'placeholder' => __('lang.please_select'),
                                      'data-live-search' => 'true', 'required']) !!}
                                  </td>
                                  <td>
                                      <input type="time" class="form-control time" name="attendances[0][check_in]"
                                          required>
                                  </td>
                                  <td>
                                      <input type="time" class="form-control time"
                                          name="attendances[0][check_out]" required>
                                  </td>
                                  <td>
                                      {!! Form::select('attendances[0][status]', ['present' => 'Present', 'late'
                                      => 'Late', 'on_leave' => 'On Leave'], null , ['class' => 'form-control
                                      selectpicker', 'data-live-search' => 'true', 'placeholder' =>
                                      __('lang.please_select'), 'required']) !!}
                                  </td>
                                  <td>
                                      {{ucfirst(Auth::user()->name)}}
                                  </td>
                              </tr>

                          </tbody>
                      </table>
      
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
<script>
    $('#add_row').click(function(){
        row_index = parseInt($('#index').val());
        row_index = row_index + 1;
        $('#index').val(row_index);
        $.ajax({
            method: 'get',
            url: '/attendance/get-attendance-row/'+row_index,
            data: {  },
            contentType: 'html',
            success: function(result) {
                $('#attendance_table tbody').append(result);
            },
        });
    })
</script>
@endpush