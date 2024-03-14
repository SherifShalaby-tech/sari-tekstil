<!-- Modal -->
<div id="form-panel{{ $opening->id }}" class="form-panel off">

    <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">{{ __('lang.edit') }}</h5>
        <button type="button" class="modal_close" onclick="toggleEditModal({{ $opening->id }})" aria-label="Close">
            <span class="cross" aria-hidden="true"></span>
        </button>
    </div>
    {!! Form::open(['route' => ['opening.update', $opening->id], 'method' => 'put', 'id' => 'opening-update-form']) !!}
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <input type="hidden" name="id" value="{{ $opening->id }}" />
            {!! Form::text('name', $opening->name, [
                'class' => 'form__field',
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
        <div class="px-3 py-2 delete-button" onclick="toggleEditModal({{ $opening->id }})">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.close')</span>
        </div>
    </div>
    {!! Form::close() !!}
</div>

{!! JsValidator::formRequest('App\Http\Requests\UpdateOpeningRequest', '#opening-update-form') !!}
