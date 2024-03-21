<!-- Modal -->
<div class="edit-overlay" onclick="closeEditModal($type->id)"></div>
<div id="form-panel{{ $store->id }}" class="form-panel off">

    <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">{{ __('lang.edit') }}</h5>
        <button type="button" class="modal_close" onclick="closeEditModal({{ $store->id }})" aria-label="Close">
            <span class="cross" aria-hidden="true"></span>
        </button>
    </div>
    {!! Form::open(['route' => ['stores.update', $store->id], 'method' => 'put', 'id' => 'opening-update-form']) !!}
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6 mb-4 d-flex align-items-end ">

                <div class="form__group">
                    <input type="hidden" name="id" value="{{ $store->id }}" />
                    {!! Form::text('name', $store->name, ['class' => 'form__field', 'placeholder' => __('lang.name'), 'required']) !!}
                    {!! Form::label('name', __('lang.name') . '*', ['class' => 'form__label']) !!}
                    @error('name')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-4 ">
                {!! Form::label('branch', __('lang.branch') . '*', [
                    'class' => 'form-label',
                    'style' => 'height:16px',
                ]) !!}
                {!! Form::select('branch_id', $branches, $store->branch_id, [
                    'class' => 'selectpicker form-control',
                    'data-live-search' => 'true',

                    'placeholder' => __('lang.please_select'),
                    'id' => 'branch_id',
                    'required',
                ]) !!}
                @error('branch_id')
                    <label class="text-danger error-msg">{{ $message }}</label>
                @enderror
            </div>
            <div class="col-md-6 mb-4 d-flex align-items-end ">
                <div class="form__group">
                    {!! Form::label('location', __('lang.location'), ['class' => 'form__label']) !!}
                    {!! Form::text('location', $store->location, ['class' => 'form__field', 'placeholder' => __('lang.location')]) !!}
                    @error('location')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-4 d-flex align-items-end ">
                <div class="form__group">
                    {!! Form::label('phone_number', __('lang.phone_number'), ['class' => 'form__label']) !!}
                    {!! Form::text('phone_number', $store->phone_number, [
                        'class' => 'form__field',
                        'placeholder' => __('lang.phone_number'),
                    ]) !!}
                    @error('phone_number')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-4 d-flex align-items-end ">
                <div class="form__group">
                    {!! Form::label('email', __('lang.email'), ['class' => 'form__label']) !!}
                    {!! Form::text('email', $store->email, ['class' => 'form__field', 'placeholder' => __('lang.email')]) !!}
                    @error('email')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-4 d-flex align-items-end ">
                <div class="form__group">
                    {!! Form::label('manager_name', __('lang.manager_name'), ['class' => 'form__label']) !!}
                    {!! Form::text('manager_name', $store->manager_name, [
                        'class' => 'form__field',
                        'placeholder' => __('lang.manager_name'),
                    ]) !!}
                    @error('manager_name')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-4 d-flex align-items-end ">
                <div class="form__group">
                    {!! Form::label('manager_mobile_number', __('lang.manager_mobile_number'), ['class' => 'form__label']) !!}
                    {!! Form::text('manager_mobile_number', $store->manager_mobile_number, [
                        'class' => 'form__field',
                        'placeholder' => __('lang.manager_mobile_number'),
                    ]) !!}
                    @error('manager_mobile_number')
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
        <div class="px-3 py-2 delete-button" onclick="closeEditModal({{ $store->id }})">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.close')</span>
        </div>
    </div>
    {!! Form::close() !!}
</div>
{{-- {!! JsValidator::formRequest('App\Http\Requests\UpdateOpeningRequest','#opening-update-form'); !!} --}}
