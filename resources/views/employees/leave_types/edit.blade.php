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
            {!! Form::open(['route' => ['leave_types.update',$leave_type->id],'method'=>'put','id'=>'leave_type-update-form' ]) !!}
                    @csrf
                    @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="id" value="{{$leave_type->id}}"/>
                    {!! Form::label('name', __( 'lang.name' ) . ':*') !!}
                    {!! Form::text('name', $leave_type->name, ['class' => 'form-control', 'placeholder' => __( 'lang.name' ), 'required'
                    ]);
                    !!}
                    @error('name')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group">
                    {{-- <input type="hidden" name="quick_add" value="{{ isset($quick_add)&&$quick_add?$quick_add:'' }}"> --}}
                    {!! Form::label('number_of_days_per_year', __( 'lang.number_of_days_per_year' ) . ':*') !!}
                    {!! Form::text('number_of_days_per_year', $leave_type->number_of_days_per_year, ['class' => 'form-control', 'placeholder' => __( 'lang.number_of_days_per_year' ), 'required'
                    ]);
                    !!}
                    @error('number_of_days_per_year')
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
{!! JsValidator::formRequest('App\Http\Requests\UpdateVacationTypeRequest','#leave_type-update-form'); !!}

