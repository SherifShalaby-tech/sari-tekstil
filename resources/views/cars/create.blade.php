@php
     $stores = App\Models\Store::pluck('name', 'id');
@endphp
<!-- Modal -->
<div class="modal fade" id="createCarModal" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog  rollIn  animated" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleStandardModalLabel">{{__('lang.add')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            {!! Form::open(['route' => 'cars.store', 'method' => 'post', 'files' => true,'id' =>'car-form' ]) !!}
                <div class="modal-body">
                    <div class="row pt-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{-- <input type="hidden" name="quick_add" value="{{ isset($quick_add)&&$quick_add?$quick_add:'' }}"> --}}
                                {!! Form::label('name', __( 'lang.name' ) . ':*') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __( 'lang.name' ), 'required'
                                ]);
                                !!}
                                @error('name')
                                    <label class="text-danger error-msg">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('weight', __( 'lang.weight' ) . ':*') !!}
                                {!! Form::text('weight', null, ['class' => 'form-control', 'placeholder' => __( 'lang.weight' ), 'required'
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
                                {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => __( 'lang.sku' ), 
                                ]);
                                !!}
                                @error('weight')
                                    <label class="text-danger error-msg">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('store', __( 'lang.store' ) . ':*') !!}
                                {!! Form::select('store_id', $stores, false,['class' => 'selectpicker form-control', 'data-live-search' => 'true', 'style' => 'width: 80%', 'placeholder' => __('lang.please_select'), 'id' => 'store_id','required']);
                                !!}
                                @error('store_id')
                                    <label class="text-danger error-msg">{{ $message }}</label>
                                @enderror
                            </div>
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

{!! JsValidator::formRequest('App\Http\Requests\StoreCarsRequest','#car-form'); !!}