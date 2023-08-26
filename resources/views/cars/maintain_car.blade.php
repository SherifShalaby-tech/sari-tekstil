<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog  rollIn  animated" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">{{__('lang.maintain_car')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            {!! Form::open(['route' => 'maintain-car.store', 'method' => 'post', 'files' => true,'id'=>'car-maintain-form' ]) !!}
            <div class="modal-body">
                <div class="row pt-5">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="hidden" value="{{!empty($expense_car)?$expense_car->car_id:null}}" name="car_id"/>
                            <input type="hidden" value="{{$car->id}}" name="id"/>
                            {!! Form::label('name', __( 'lang.name' ) . ':*') !!}
                            {!! Form::text('name', $car->name, ['class' => 'form-control', 'placeholder' => __( 'lang.name' ), 'disabled'
                            ]);
                            !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('sku', __( 'lang.sku' ) . ':*') !!}
                            {!! Form::text('sku', $car->sku, ['class' => 'form-control', 'placeholder' => __( 'lang.sku' ), 'disabled'
                            ]);
                            !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('date_of_creation', __( 'lang.date_of_creation' ) . ':*') !!}
                            {!! Form::date('date_of_creation', !empty($expense_car)?$expense_car->date_of_creation:now()->format('Y-m-d'), ['class' => 'form-control', 'placeholder' => __( 'lang.date_of_creation' ), 'required'
                            ]);
                            !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('cost', __( 'lang.cost' ) . ':*') !!}
                            {!! Form::number('cost', !empty($expense_car)?@num_format($expense_car->cost):null, ['class' => 'form-control', 'placeholder' => __( 'lang.cost' ), 'required'
                            ]);
                            !!}
                            @error('cost')
                                <label class="text-danger error-msg">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="upload_files">@lang('lang.upload_files')</label><br>
                        <input type="file" name="upload_files[]"  multiple>
                        {{!empty($expense_car)?count($expense_car->files).' Files Uploaded':''}}
                    </div>
                    <div class="col-md-12 pt-3">
                        <label for="details">@lang('lang.details')</label>
                        {!! Form::textarea('notes', !empty($expense_car)?$expense_car->notes:null, ['class' => 'form-control', 'rows' => 3, 'placeholder' =>
                        __('lang.details'), 'id' => 'textInput','oninput'=>"checkLetterCount()"]) !!}
                        <p id="letterCount">0 letters out of 250</p>
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
<script>
    function checkLetterCount() {
        const textarea = document.getElementById('textInput');
        const letterCount = textarea.value.replace(/\s/g, '').length;

        if (letterCount > 250) {
            textarea.value = textarea.value.substr(0, 250);
            updateLetterCount(250);
        } else {
            updateLetterCount(letterCount);
        }
    }

    function updateLetterCount(count) {
        document.getElementById('letterCount').textContent = `${count} letters out of 250`;
    }
</script>


