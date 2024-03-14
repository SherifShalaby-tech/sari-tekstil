<!-- Modal -->
<div id="form-panel{{ $store->id }}" class="form-panel off">

    <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">{{ __('lang.edit') }}</h5>
        <button type="button" class="modal_close" onclick="toggleEditModal({{ $store->id }})" aria-label="Close">
            <span class="cross" aria-hidden="true"></span>
        </button>
    </div>
    {!! Form::open(['route' => ['stores.update', $store->id], 'method' => 'put', 'id' => 'opening-update-form']) !!}
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form__group">
            <input type="hidden" name="id" value="{{ $store->id }}" />
            {!! Form::text('name', $store->name, ['class' => 'form__field', 'placeholder' => __('lang.name'), 'required']) !!}
            {!! Form::label('name', __('lang.name') . '*', [
                'class' => 'form__label',
            ]) !!}
            @error('name')
                <label class="text-danger error-msg">{{ $message }}</label>
            @enderror
        </div>
        <div class="form-">
            {!! Form::label('branch', __('lang.branch') . '*', ['class' => 'form-label', 'style' => 'height:16px']) !!}
            {!! Form::select('branch_id', $branches, $store->branch_id, [
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true',
                'style' => 'width: 80%',
                'placeholder' => __('lang.please_select'),
                'id' => 'branch_id',
                'required',
            ]) !!}
            @error('branch_id')
                <label class="text-danger error-msg">{{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">

            {!! Form::label('store', __('lang.store') . '*', ['class' => 'form-label', 'style' => 'height:16px']) !!}
            {!! Form::select('store_id', $stores, false, [
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true',
                'style' => 'width: 80%',
                'placeholder' => __('lang.please_select'),
                'id' => 'store_id',
                'required',
            ]) !!}
            @error('store_id')
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
        <div class="px-3 py-2 delete-button" onclick="toggleEditModal({{ $store->id }})">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.close')</span>
        </div>
    </div>
    {!! Form::close() !!}
</div>
{{-- {!! JsValidator::formRequest('App\Http\Requests\UpdateOpeningRequest','#opening-update-form'); !!} --}}
