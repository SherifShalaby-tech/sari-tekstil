<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog  rollIn  animated modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleStandardModalLabel">{{__('lang.add')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            {!! Form::open(['route' => 'forfeit-leaves.store', 'method' => 'post', 'files' => true,'id' =>'leave-form' ]) !!}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="employee_id">@lang('lang.name')</label>
                            {!! Form::select('employee_id', $employees, $this_employee_id, ['class' => 'form-control selectpicker', 'id' =>
                            'employee_id', 'required', 'placeholder' => __('lang.please_select'), 'data-live-search' => 'true']) !!}
                        </div>
                    </div>
                </div>
                <div class="row mb-2 jobtypes hide">
                    <h5 id="employee_name" class="col-md-6"></h5>
                    <h5 id="joing_date" class="col-md-6"></h5>
                    <h5 id="job_title" class="col-md-6"></h5>
                    <h5 id="no_of_emplyee_same_job" class="col-md-6"></h5>
                    <h5 id="leave_balance" class="col-md-6"></h5>
    
                    <div class="leave_balance_details col-md-12"></div>
                </div>
    
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="leave_type_id">@lang('lang.select_type_of_leave')</label>
                            {!! Form::select('leave_type_id', $leave_types, false, ['class' => 'form-control', 'required',
                            'placeholder' => 'Please Select', 'id' => 'leave_type_id']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="number_of_days">@lang('lang.number_of_days')</label>
                        <input class="form-control" type="number" id="number_of_days" step=".01" name="number_of_days" required>
                    </div>
                    <div class="col-md-4">
                        <label for="start_date">@lang('lang.year')</label>
                        <input class="form-control" type="date" id="start_date" name="start_date" required>
                    </div>
    
                    <div class="col-md-4">
                        <label for="upload_files">@lang('lang.upload_files')</label><br>
                        <input type="file" name="upload_files[]"  multiple>
                    </div>
                    <div class="col-md-12">
                        <label for="reason">@lang('lang.reason')</label>
                        {!! Form::textarea('details', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' =>
                        __('lang.reason'), 'id' => 'reason']) !!}
                    </div>
    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('lang.close')</button>
                <button  id="create-nationality-btn" class="btn btn-primary">{{__('lang.save')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
