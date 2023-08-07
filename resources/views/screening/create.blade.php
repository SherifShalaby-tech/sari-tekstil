<!-- Modal -->
@php
     $openings = App\Models\Opening::pluck('name', 'id');
@endphp
<div class="modal fade" id="createScreeningModal" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog  rollIn  animated" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleStandardModalLabel">{{__('lang.add')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            {!! Form::open(['route' => 'screening.store', 'method' => 'post', 'files' => true,'id' =>'screening-form' ]) !!}
            <div class="modal-body">
                {{-- <div class="row pt-5"> --}}
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
                    <div class="form-group">
                        {{-- <input type="hidden" name="quick_add" value="{{ isset($quick_add)&&$quick_add?$quick_add:'' }}"> --}}
                        {!! Form::label('opening', __( 'lang.opening' ) . ':*') !!}
                        {!! Form::select('opening_id', $openings, false, ['class' => 'selectpicker form-control', 'data-live-search' => 'true', 'style' => 'width: 80%', 'placeholder' => __('lang.please_select'), 'id' => 'opening_id']) !!}
                        @error('name')
                            <label class="text-danger error-msg">{{ $message }}</label>
                        @enderror
                    </div>
                {{-- </div> --}}
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