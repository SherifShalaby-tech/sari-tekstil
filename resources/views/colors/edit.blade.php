<!-- Modal -->
<div id="form-panel{{ $color->id }}" class="form-panel off">
    <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">{{ __('lang.edit') }}</h5>
        <button type="button" class="modal_close" onclick="toggleEditModal({{ $color->id }})" aria-label="Close">
            <span class="cross" aria-hidden="true"></span>
        </button>
    </div>
    {!! Form::open(['route' => ['colors.update', $color->id], 'method' => 'put', 'id' => 'color-update-form']) !!}
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form__group field w-50 m-auto">
            <input type="hidden" name="id" value="{{ $color->id }}" />
            {!! Form::text('name', $color->name, [
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
    <div class="modal-footer">
        <button type="submit" class="px-3 py-2 submit-button">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.save')</span>
        </button>
        <div class="px-3 py-2 delete-button" onclick="toggleEditModal({{ $color->id }})">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.close')</span>
        </div>
    </div>
    {!! Form::close() !!}
</div>
</div>
</div>
{!! JsValidator::formRequest('App\Http\Requests\UpdateColorRequest', '#color-update-form') !!}
