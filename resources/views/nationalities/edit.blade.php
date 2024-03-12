<div id="form-panel{{ $nationality->id }}" class="form-panel off">

    <div class="modal-header">
        <h5 class="modal-title" id="exampleStandardModalLabel">{{ __('lang.edit') }}</h5>
        <button type="button" class="modal_close" onclick="toggleEditModal({{ $nationality->id }})" aria-label="Close">
            <span class="cross" aria-hidden="true"></span>
        </button>
    </div>
    {!! Form::open([
        'route' => ['nationality.update', $nationality->id],
        'method' => 'put',
        'id' => 'nationality-update-form',
    ]) !!}
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form__group field w-50 m-auto">
            <input type="hidden" name="id" value="{{ $nationality->id }}" />
            {!! Form::text('name', $nationality->name, [
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
        <div class="px-3 py-2 delete-button" onclick="toggleEditModal({{ $nationality->id }})">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.close')</span>
        </div>
    </div>
    {!! Form::close() !!}
</div>

{!! JsValidator::formRequest('App\Http\Requests\UpdateNationalityRequest', '#nationality-update-form') !!}
