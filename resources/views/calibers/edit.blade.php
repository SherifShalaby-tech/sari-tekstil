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
            {!! Form::open(['route' => ['calibers.update',$caliber->id],'method'=>'put','id'=>'ccaliberar-update-form' ]) !!}
                    @csrf
                    @method('PUT')
            <div class="modal-body">
                <div class="row pt-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{-- <input type="hidden" name="quick_add" value="{{ isset($quick_add)&&$quick_add?$quick_add:'' }}"> --}}
                            {!! Form::label('number', __( 'lang.number' ) . ':*') !!}
                            {!! Form::text('number', $caliber->number, ['class' => 'form-control', 'placeholder' => __( 'lang.number' ), 'required'
                            ]);
                            !!}
                            @error('number')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                   
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('store', __( 'lang.store' ) . ':*') !!}
                            {!! Form::text('store_id', null, ['class' => 'form-control', 'placeholder' => __( 'lang.store' ), 'required'
                            ]);
                            !!}
                            @error('weight')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                    </div> --}}
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

