<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog  rollIn  animated modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleStandardModalLabel">{{__('lang.edit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            {!! Form::open(['route' => ['leaves.update',$leave->id],'method'=>'put','id'=>'leave-update-form' , 'files' => true]) !!}
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="employee_id">@lang('lang.name')</label>
                            {!! Form::select('employee_id', $employees, $leave->employee_id, ['class' => 'form-control selectpicker', 'id' =>
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
                            {!! Form::select('leave_type_id', $leave_types, $leave->leave_type_id, ['class' => 'form-control', 'required',
                            'placeholder' => 'Please Select']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="start_date">@lang('lang.start_date')</label>
                        <input class="form-control" type="date" id="start_date" value="{{$leave->start_date}}" name="start_date" required>
                    </div>
                    <div class="col-md-4">
                        <label for="end_date">@lang('lang.end_date')</label>
                        <input class="form-control" type="date" id="end_date" value="{{$leave->end_date}}" name="end_date" required>
                    </div>
                    <div class="col-md-4">
                        <label for="rejoining_date">@lang('lang.rejoining_date')</label>
                        <input class="form-control" type="date" id="rejoining_date" value="{{$leave->rejoining_date}}" name="rejoining_date" required>
                    </div>
                    <div class="col-md-4">
                        <label for="paid_or_not_paid">@lang('lang.paid_not_paid')</label>
                        {!! Form::select('paid_or_not_paid', ['paid' => 'Paid', 'not_paid' => 'Not Paid'], $leave->paid_or_not_paid, ['class' =>
                        'form-control', 'placeholder' => 'Please Select', 'id' => 'paid_or_not_paid', 'required']) !!}
                    </div>
                    <div class="col-md-4 if_paid hide">
                        <label for="amount_to_paid">@lang('lang.amount_to_paid')</label>
                        {!! Form::text('amount_to_paid', $leave->amount_to_paid, ['class' => 'form-control', 'placeholder' =>
                        __('lang.amount_to_paid'), 'id' => 'amount_to_paid']) !!}
                    </div>
                    <div class="col-md-4 if_paid hide">
                        <label for="payment_date">@lang('lang.payment_date')</label>
                        {!! Form::date('payment_date', $leave->payment_date, ['class' => 'form-control datepicker', 'placeholder' =>
                        __('lang.payment_date'), 'id' => 'payment_date']) !!}
                    </div>
                    <div class="col-md-4">
                        <label for="upload_files">@lang('lang.upload_files')</label><br>
                        {{-- {!! Form::file('upload_files', null, ['class' => 'form-control', 'placeholder' =>
                        __('lang.upload_files'), 'id' => 'upload_files']) !!} --}}
                        <input type="file" name="upload_files[]"  multiple>
                    </div>
                    <div class="col-md-12">
                        <label for="details">@lang('lang.details')</label>
                        {!! Form::textarea('details', $leave->details, ['class' => 'form-control', 'rows' => 3, 'placeholder' =>
                        __('lang.details'), 'id' => 'details']) !!}
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