<!-- Modal -->
<div class="modal fade" id="createBranchModal" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog  rollIn  animated" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleStandardModalLabel">{{__('lang.add')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            {!! Form::open(['route' => 'branches.store', 'method' => 'post', 'files' => true,'id' =>'branch-form' ]) !!}
            <div class="modal-body">
                <div class="form-group">
                   
                    {!! Form::label('name', __( 'lang.name' ) . ':*') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __( 'lang.name' ), 'required'
                    ]);
                    !!}
                    @error('name')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                   
                    {!! Form::label('location', __( 'lang.location' ) . ':*') !!}
                    {!! Form::text('location', null, ['class' => 'form-control', 'placeholder' => __( 'lang.location' ), 
                    ]);
                    !!}
                    @error('location')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                   
                    {!! Form::label('phone_number', __( 'lang.phone_number' ) . ':*') !!}
                    {!! Form::text('phone_number', null, ['class' => 'form-control', 'placeholder' => __( 'lang.phone_number' ), 
                    ]);
                    !!}
                    @error('phone_number')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                   
                    {!! Form::label('email', __( 'lang.email' ) . ':*') !!}
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => __( 'lang.email' ), 
                    ]);
                    !!}
                    @error('email')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                   
                    {!! Form::label('manager_name', __( 'lang.manager_name' ) . ':*') !!}
                    {!! Form::text('manager_name', null, ['class' => 'form-control', 'placeholder' => __( 'lang.manager_name' ), 
                    ]);
                    !!}
                    @error('manager_name')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                   
                    {!! Form::label('manager_mobile_number', __( 'lang.manager_mobile_number' ) . ':*') !!}
                    {!! Form::text('manager_mobile_number', null, ['class' => 'form-control', 'placeholder' => __( 'lang.manager_mobile_number' ), 
                    ]);
                    !!}
                    @error('manager_mobile_number')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
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

{{-- {!! JsValidator::formRequest('App\Http\Requests\StoreOpeningRequest','#opening-form'); !!} --}}