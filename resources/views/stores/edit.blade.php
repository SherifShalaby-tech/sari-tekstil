<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog  rollIn  animated" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">{{__('lang.edit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            {!! Form::open(['route' => ['stores.update',$store->id],'method'=>'put','id'=>'opening-update-form' ]) !!}
                    @csrf
                    @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="id" value="{{$store->id}}"/>
                    {!! Form::label('name', __( 'lang.name' ) . ':*') !!}
                    {!! Form::text('name', $store->name, ['class' => 'form-control', 'placeholder' => __( 'lang.name' ), 'required'
                    ]);
                    !!}
                    @error('name')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('branch', __( 'lang.branch' ) . ':*') !!}
                    {!! Form::select('branch_id', $branches,$store->branch_id , ['class' => 'selectpicker form-control', 'data-live-search' => 'true', 'style' => 'width: 80%', 'placeholder' => __('lang.please_select'), 'id' => 'branch_id','required']) !!}
                    @error('branch_id')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('location', __( 'lang.location' ) ) !!}
                    {!! Form::text('location', $store->location, ['class' => 'form-control', 'placeholder' => __( 'lang.location' ), 
                    ]);
                    !!}
                    @error('location')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('phone_number', __( 'lang.phone_number' ) ) !!}
                    {!! Form::text('phone_number', $store->phone_number, ['class' => 'form-control', 'placeholder' => __( 'lang.phone_number' ), 
                    ]);
                    !!}
                    @error('phone_number')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('email', __( 'lang.email' ) ) !!}
                    {!! Form::text('email', $store->email, ['class' => 'form-control', 'placeholder' => __( 'lang.email' ), 
                    ]);
                    !!}
                    @error('email')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('manager_name', __( 'lang.manager_name' )) !!}
                    {!! Form::text('manager_name', $store->manager_name, ['class' => 'form-control', 'placeholder' => __( 'lang.manager_name' ), 
                    ]);
                    !!}
                    @error('manager_name')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('manager_mobile_number', __( 'lang.manager_mobile_number' ) ) !!}
                    {!! Form::text('manager_mobile_number', $store->manager_mobile_number, ['class' => 'form-control', 'placeholder' => __( 'lang.manager_mobile_number' ), 
                    ]);
                    !!}
                    @error('manager_mobile_number')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('lang.close')}}</button>
                <button type="submit" class="btn btn-primary">{{__('lang.save')}}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
{{-- {!! JsValidator::formRequest('App\Http\Requests\UpdateOpeningRequest','#opening-update-form'); !!} --}}

