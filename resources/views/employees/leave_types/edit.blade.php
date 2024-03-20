<!-- Modal -->
<div id="form-panel{{ $leave_type->id }}" class="form-panel off">

    <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">{{ __('lang.edit') }}</h5>
        <button type="button" class="modal_close" onclick="toggleEditModal({{ $leave_type->id }})" aria-label="Close">
            <span class="cross" aria-hidden="true"></span>
        </button>
    </div>
    {!! Form::open([
        'route' => ['leave_types.update', $leave_type->id],
        'method' => 'put',
        'id' => 'leave_type-update-form',
    ]) !!}
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row">


            <div class="col-md-12 mb-4">
                <div class="form__group w-50 m-auto">
                    <input type="hidden" name="id" value="{{ $leave_type->id }}" />
                    {!! Form::text('name', $leave_type->name, [
                        'class' => 'form-control',
                        'placeholder' => __('lang.name'),
                        'required',
                    ]) !!}
                    {!! Form::label('name', __('lang.name') . '*', [
                        'class' => 'form__field',
                    ]) !!}
                    @error('name')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="form__group w-50 m-auto">

                    {{-- <input type="hidden" name="quick_add" value="{{ isset($quick_add)&&$quick_add?$quick_add:'' }}"> --}}
                    {!! Form::text('number_of_days_per_year', $leave_type->number_of_days_per_year, [
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
        <button type="submit" class="px-3 py-2 submit-button">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.save')</span>
        </button>
        <div class="px-3 py-2 delete-button" onclick="toggleEditModal({{ $leave_type->id }})">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.close')</span>
        </div>
    </div>
    {!! Form::close() !!}
</div>

{!! JsValidator::formRequest('App\Http\Requests\UpdateVacationTypeRequest', '#leave_type-update-form') !!}
