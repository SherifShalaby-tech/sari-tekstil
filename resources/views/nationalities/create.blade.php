<!-- Modal -->
<div class="modal fade" id="createNationalityModal" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog  rollIn  animated" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleStandardModalLabel">{{ __('lang.add') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            {!! Form::open([
                'route' => 'nationality.store',
                'method' => 'post',
                'files' => true,
                'id' => 'nationality-form',
            ]) !!}
            <div class="modal-body">
                <div class="form__group field">
                    {{-- <input type="hidden" name="quick_add" value="{{ isset($quick_add)&&$quick_add?$quick_add:'' }}"> --}}
                    {!! Form::text('name', null, ['class' => 'form__field', 'placeholder' => __('lang.name'), 'required']) !!}
                    {!! Form::label('name', __('lang.name') . '*', [
                        'class' => 'form__label',
                    ]) !!}
                    @error('name')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('lang.close')</button>
                <button id="create-nationality-btn" class="btn btn-primary">{{ __('lang.save') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

{!! JsValidator::formRequest('App\Http\Requests\NationalityRequest', '#nationality-form') !!}
{{-- {!! JsValidator::formRequest('App\Http\Requests\NationalityRequest','#quick_add_nationality_form'); !!} --}}
