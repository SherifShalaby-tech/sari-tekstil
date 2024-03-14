<!-- Modal -->
<div id="form-panel{{ $caliber->id }}" class="form-panel off">

    <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">{{ __('lang.edit') }}</h5>
        <button type="button" class="modal_close" onclick="toggleEditModal({{ $caliber->id }})" aria-label="Close">
            <span class="cross" aria-hidden="true"></span>
        </button>
    </div>
    {!! Form::open([
        'route' => ['calibers.update', $caliber->id],
        'method' => 'put',
        'id' => 'ccaliberar-update-form',
    ]) !!}
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row ">
            <div class="col-md-6 d-flex align-items-end">
                <div class="form__group">
                    {{-- <input type="hidden" name="quick_add" value="{{ isset($quick_add)&&$quick_add?$quick_add:'' }}"> --}}
                    {!! Form::label('number', __('lang.number') . '*', [
                        'class' => 'form__label',
                    ]) !!}
                    {!! Form::text('number', $caliber->number, [
                        'class' => 'form__field',
                        'placeholder' => __('lang.number'),
                        'required',
                    ]) !!}
                    @error('number')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mb-0">
                    {!! Form::label('store', __('lang.store') . '*', [
                        'style' => 'height:16px',
                        'class' => 'form-label',
                    ]) !!}
                    {!! Form::select('store_id', $stores, $caliber->store_id, [
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
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="px-3 py-2 submit-button">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.save')</span>
        </button>
        <div class="px-3 py-2 delete-button" onclick="toggleEditModal({{ $caliber->id }})">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.close')</span>
        </div>
    </div>
    {!! Form::close() !!}
</div>
