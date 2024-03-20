<!-- Modal -->
<div class="overlay" onclick="closeModal()"></div>
<div id="form-panel" class="form-panel off">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleStandardModalLabel">{{ __('lang.add') }}</h5>
        <button type="button" class="modal_close" onclick="toggleModal()" aria-label="Close">
            <span class="cross" aria-hidden="true"></span>
        </button>
    </div>
    {!! Form::open(['route' => 'leave_types.store', 'method' => 'post', 'files' => true, 'id' => 'leave-type-form']) !!}
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 mb-4">

                <div class="form__group w-50 m-auto">
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
            <div class="col-md-12 mb-4">

                <div class="form__group w-50 m-auto">
                    {{-- <input type="hidden" name="quick_add" value="{{ isset($quick_add)&&$quick_add?$quick_add:'' }}"> --}}
                    {!! Form::text('number_of_days_per_year', null, [
                        'class' => 'form__field',
                        'placeholder' => __('lang.number_of_days_per_year'),
                        'required',
                    ]) !!}
                    {!! Form::label('number_of_days_per_year', __('lang.number_of_days_per_year') . '*', [
                        'class' => 'form__label',
                    ]) !!}
                    @error('number_of_days_per_year')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="create-nationality-btn" type="submit" class="p-3 submit-button">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.save')</span>
        </button>
        <button type="button" class="p-3 delete-button" onclick="toggleModal()">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.close')</span>
        </button>
    </div>
    {!! Form::close() !!}
</div>


{!! JsValidator::formRequest('App\Http\Requests\VacationTypeRequest', '#leave-type-form') !!}
{{-- {!! JsValidator::formRequest('App\Http\Requests\NationalityRequest','#quick_add_nationality_form'); !!} --}}
