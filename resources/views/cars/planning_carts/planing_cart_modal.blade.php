<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog  rollIn  animated modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">{{__('lang.add_aplan')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            {!! Form::open(['route' => ['planning-carts.update',$car->id],'method'=>'put','id'=>'car-plan-form' ]) !!}
                    @csrf
                    @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="hidden" value="{{$car->id}}" name="id"/>
                            {!! Form::label('name', __( 'lang.name' ) . ':*') !!}
                            {!! Form::text('name', $car->name, ['class' => 'form-control', 'placeholder' => __( 'lang.name' )
                            ]);
                            !!}
                        </div>
                    </div>
                  
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('sku', __( 'lang.sku' ) . ':*') !!}
                            {!! Form::text('sku', $car->sku, ['class' => 'form-control', 'placeholder' => __( 'lang.sku' )
                            ]);
                            !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('recent_place', __( 'lang.recent_place' ) . ':*') !!}
                            {!! Form::select('recent_place', $places,  !empty($car->recent_place)?$car->recent_place:null, ['class' => 'selectpicker form-control recent_place', 'data-live-search' => 'true', 'placeholder' => '-']) !!}
                            @error('recent_place')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('recent_car_content', __( 'lang.recent_car_content' ) . ':*') !!}
                            {!! Form::text('recent_car_content', $car->recent_car_content, ['class' => 'form-control', 'placeholder' => '-'
                            ]);
                            !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('weight_empty', __( 'lang.weight_empty' ) . ':*') !!}
                            {!! Form::number('weight_empty', @num_format($car->weight_empty), ['class' => 'form-control', 'placeholder' => __( 'lang.weight_empty' ), 'required'
                            ]);
                            !!}
                            @error('weight_empty')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('weight_product', __( 'lang.weight_product' ) . ':*') !!}
                            {!! Form::number('weight_product', @num_format($car->weight_product), ['class' => 'form-control', 'placeholder' => __( 'lang.weight_product' ), 'required'
                            ]);
                            !!}
                            @error('weight_product')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('process', __( 'lang.recent_process' ) . ':*') !!}
                            {!! Form::select('process', $processes,  !empty($car->process)?$car->process:NULL, ['class' => 'selectpicker form-control process', 'data-live-search' => 'true', 'placeholder' => '-']) !!}
                            @error('process')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('next_process', __( 'lang.next_process' ) . ':*') !!}
                            {!! Form::select('next_process', $processes,  !empty($car->next_process)?$car->next_process:NULL, ['class' => 'selectpicker form-control next_process', 'data-live-search' => 'true', 'placeholder' => '-']) !!}
                            @error('next_process')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('next_place', __( 'lang.next_place' ) . ':*') !!}
                            {!! Form::select('next_place', $places,  !empty($car->next_place)?$car->next_place:null, ['class' => 'form-control next_place', 'placeholder' => '-']) !!}
                            @error('next_place')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('caliber_id', __( 'lang.caliber' ) . ':*') !!}
                            {!! Form::select('caliber_id[]', $calibars,  !empty($car->caliber_id)?$car->caliber_id:null, ['class' => 'selectpicker form-control', 'data-live-search' => 'true','multiple']) !!}
                            @error('caliber_id')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('employee', __( 'lang.employee' ) . ':*') !!}
                            {!! Form::select('employee_id[]', $employees,  !empty($car->employee)?$car->employee_id:null, ['class' => 'selectpicker form-control employee', 'data-live-search' => 'true','multiple']) !!}
                            @error('employee_id')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('next_employee_id', __( 'lang.next_employee' ) . ':*') !!}
                            {!! Form::select('next_employee_id[]', $employees,  !empty($car->next_employee_id)?$car->next_employee_id:null, ['class' => 'selectpicker form-control next_employee_id', 'data-live-search' => 'true','multiple']) !!}
                            @error('next_employee_id')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>

                 
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
{{-- {!! JsValidator::formRequest('App\Http\Requests\CarPlanRequest','#car-plan-form'); !!} --}}

