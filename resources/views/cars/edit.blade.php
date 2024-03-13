<div id="form-panel{{ $car->id }}" class="form-panel off">
    <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">{{ __('lang.edit') }}</h5>
        <button type="button" class="modal_close" onclick="toggleEditModal({{ $car->id }})" aria-label="Close">
            <span class="cross" aria-hidden="true"></span>
        </button>
    </div>
    {!! Form::open(['route' => ['cars.update', $car->id], 'method' => 'put', 'id' => 'car-update-form']) !!}
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6 d-flex align-items-end mb-4">
                <div class="form__group">
                    <input type="hidden" name="id" value="{{ $car->id }}" />
                    {{-- <input type="hidden" name="quick_add" value="{{ isset($quick_add)&&$quick_add?$quick_add:'' }}"> --}}
                    {!! Form::text('name', $car->name, ['class' => 'form__field', 'placeholder' => __('lang.name'), 'required']) !!}
                    {!! Form::label('name', __('lang.name') . '*', [
                        'class' => 'form__label',
                    ]) !!}
                    @error('name')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6  mb-4">
                <div class="form-group">
                    <label class="form-label mb-3" for="branch_id">@lang('lang.branch')</label>
                    {!! Form::select('branch_id', $branches, $car->branch_id, [
                        'class' => 'form-control',
                        'required',
                        'placeholder' => __('lang.please_select'),
                    ]) !!}
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-end mb-4">
                <div class="form__group">
                    {!! Form::number('weight_empty', @num_format($car->weight_empty), [
                        'class' => 'form__field',
                        'placeholder' => __('lang.weight_empty'),
                        'required',
                    ]) !!}
                    {!! Form::label('weight', __('lang.weight_empty') . '*', [
                        'class' => 'form__label',
                    ]) !!}
                    @error('weight')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-end mb-4">
                <div class="form__group">
                    {!! Form::text('sku', $car->sku, ['class' => 'form__field', 'placeholder' => __('lang.sku')]) !!}
                    {!! Form::label('sku', __('lang.sku') . '*', [
                        'class' => 'form__label',
                    ]) !!}
                    @error('sku')
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
        <div class="px-3 py-2 delete-button" onclick="toggleEditModal({{ $car->id }})">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.close')</span>
        </div>
    </div>
    {!! Form::close() !!}
</div>
</div>
</div>
{!! JsValidator::formRequest('App\Http\Requests\UpdateCarsRequest', '#car-update-form') !!}
