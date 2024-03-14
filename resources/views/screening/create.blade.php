<!-- Modal -->
@php
    $openings = App\Models\Opening::pluck('name', 'id');
@endphp
<div class="overlay" onclick="closeModal()"></div>
<div id="form-panel" class="form-panel off">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleStandardModalLabel">{{ __('lang.add') }}</h5>
        <button type="button" class="modal_close" onclick="toggleModal()" aria-label="Close">
            <span class="cross" aria-hidden="true"></span>
        </button>
    </div>
    {!! Form::open(['route' => 'screening.store', 'method' => 'post', 'files' => true, 'id' => 'screening-form']) !!}
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">

                <div class="form__group">
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
            <div class="col-md-6">

                {{-- <input type="hidden" name="quick_add" value="{{ isset($quick_add)&&$quick_add?$quick_add:'' }}"> --}}
                {!! Form::label('opening', __('lang.opening') . ':*') !!}
                {!! Form::select('opening_id', $openings, false, [
                    'class' => 'selectpicker',
                    'data-live-search' => 'true',

                    'placeholder' => __('lang.please_select'),
                    'id' => 'opening_id',
                    'required',
                ]) !!}
                @error('name')
                    <label class="text-danger error-msg">{{ $message }}</label>
                @enderror
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


{{-- {!! JsValidator::formRequest('App\Http\Requests\StoreOpeningRequest','#opening-form'); !!} --}}
