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
            {!! Form::open(['route' => ['cars.update',$car->id],'method'=>'put','id'=>'car-update-form' ]) !!}
                    @csrf
                    @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{$car->id}}"/>
                            {{-- <input type="hidden" name="quick_add" value="{{ isset($quick_add)&&$quick_add?$quick_add:'' }}"> --}}
                            {!! Form::label('name', __( 'lang.name' ) . ':*') !!}
                            {!! Form::text('name', $car->name, ['class' => 'form-control', 'placeholder' => __( 'lang.name' ), 'required'
                            ]);
                            !!}
                            @error('name')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="branch_id">@lang('lang.branch')</label>
                            {!! Form::select('branch_id', $branches, $car->branch_id, ['class' => 'form-control', 'required',
                            'placeholder' =>  __('lang.please_select')]) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('weight', __( 'lang.weight_empty' ) . ':*') !!}
                            {!! Form::number('weight_empty', @num_format($car->weight_empty), ['class' => 'form-control', 'placeholder' => __( 'lang.weight_empty' ), 'required'
                            ]);
                            !!}
                            @error('weight')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('sku', __( 'lang.sku' ) . ':*') !!}
                            {!! Form::text('sku', $car->sku, ['class' => 'form-control', 'placeholder' => __( 'lang.sku' ), 
                            ]);
                            !!}
                            @error('sku')
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
{!! JsValidator::formRequest('App\Http\Requests\UpdateCarsRequest','#car-update-form'); !!}

