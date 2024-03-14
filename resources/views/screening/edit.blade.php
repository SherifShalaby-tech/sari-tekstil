<!-- Modal -->
<div id="form-panel{{ $screening->id }}" class="form-panel off">
    <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">{{ __('lang.edit') }}</h5>
        <button type="button" class="modal_close" onclick="toggleEditModal({{ $screening->id }})" aria-label="Close">
            <span class="cross" aria-hidden="true"></span>
        </button>
    </div>
    {!! Form::open([
        'route' => ['screening.update', $screening->id],
        'method' => 'put',
        'id' => 'screening-update-form',
    ]) !!}
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6 d-flex align-items-end">
                <div class="form__group">
                    <input type="hidden" name="id" value="{{ $screening->id }}" />
                    {!! Form::text('name', $screening->name, [
                        'class' => 'form__field',
                        'style' => 'padding: 9px 0 0',
                        'placeholder' => __('lang.name'),
                        'required',
                    ]) !!}
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
                {!! Form::label('opening', __('lang.opening') . '*', [
                    'class' => 'form-label',
                ]) !!}
                {!! Form::select('opening_id', $openings, $screening->opening_id, [
                    'class' => 'selectpicker form-control',
                    'data-live-search' => 'true',
                    'style' => 'width: 80%',
                    'placeholder' => __('lang.please_select'),
                    'id' => 'opening_id',
                    'required',
                ]) !!}
                @error('opening_id')
                    <label class="text-danger error-msg">{{ $message }}</label>
                @enderror
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="px-3 py-2 submit-button">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.save')</span>
        </button>
        <div class="px-3 py-2 delete-button" onclick="toggleEditModal({{ $screening->id }})">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.close')</span>
        </div>
    </div>
    {!! Form::close() !!}
</div>

{{-- {!! JsValidator::formRequest('App\Http\Requests\UpdateOpeningRequest','#opening-update-form'); !!} --}}

{{--  --}}
