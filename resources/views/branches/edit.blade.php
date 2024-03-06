<div id="panel{{ $branch->id }}" class="panel off">
    <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">{{ __('lang.edit') }}</h5>
        <button type="button" class="modal_close" onclick="toggleEditModal({{ $branch->id }})" aria-label="Close">
            <span class="cross" aria-hidden="true"></span>
        </button>
    </div>
    {!! Form::open(['route' => ['branches.update', $branch->id], 'method' => 'put', 'id' => 'branches-update-form']) !!}
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row">

            <div class="col-md-6 mb-3">
                <div class="form__group ">
                    <input type="hidden" name="id" value="{{ $branch->id }}" />
                    {!! Form::text('name', $branch->name, [
                        'class' => 'form__field',
                        'style' => 'padding:9px 0 0',
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
            <div class="col-md-6 mb-3">
                <div class="form__group ">
                    {!! Form::text('location', $branch->location, [
                        'class' => 'form__field',
                        'style' => 'padding:9px 0 0',
                        'placeholder' => __('lang.location'),
                    ]) !!}
                    {!! Form::label('location', __('lang.location'), [
                        'class' => 'form__label',
                    ]) !!}
                    @error('location')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form__group ">
                    {!! Form::text('phone_number', $branch->phone_number, [
                        'class' => 'form__field',
                        'style' => 'padding:9px 0 0',
                        'placeholder' => __('lang.phone_number'),
                    ]) !!}
                    {!! Form::label('phone_number', __('lang.phone_number'), [
                        'class' => 'form__label',
                    ]) !!}
                    @error('phone_number')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form__group ">
                    {!! Form::text('email', $branch->email, [
                        'class' => 'form__field',
                        'style' => 'padding:9px 0 0',
                        'placeholder' => __('lang.email'),
                    ]) !!}
                    {!! Form::label('email', __('lang.email'), [
                        'class' => 'form__label',
                    ]) !!}
                    @error('email')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form__group ">
                    {!! Form::text('manager_name', $branch->manager_name, [
                        'class' => 'form__field',
                        'style' => 'padding:9px 0 0',
                        'placeholder' => __('lang.manager_name'),
                    ]) !!}
                    {!! Form::label('manager_name', __('lang.manager_name'), [
                        'class' => 'form__label',
                    ]) !!}
                    @error('manager_name')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form__group ">
                    {!! Form::text('manager_mobile_number', $branch->manager_mobile_number, [
                        'class' => 'form__field',
                        'style' => 'padding:9px 0 0',
                        'placeholder' => __('lang.manager_mobile_number'),
                    ]) !!}
                    {!! Form::label('manager_mobile_number', __('lang.manager_mobile_number'), [
                        'class' => 'form__label',
                    ]) !!}
                    @error('manager_mobile_number')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="create-nationality-btn" type="submit" class="px-3 py-2 submit-button">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.save')</span>
        </button>
        <button type="button" class="px-3 py-2 delete-button" onclick="toggleModal()">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.close')</span>
        </button>
    </div>
    {!! Form::close() !!}
</div>

{{-- {!! JsValidator::formRequest('App\Http\Requests\UpdateOpeningRequest','#opening-update-form'); !!} --}}
