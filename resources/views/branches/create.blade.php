<div class="overlay" onclick="closeModal()"></div>

<div id="form-panel" class="form-panel off">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleStandardModalLabel">{{ __('lang.add') }}</h5>
        <button type="button" class="modal_close" onclick="toggleModal()">
            <span class="cross" aria-hidden="true"></span>
        </button>
    </div>
    {!! Form::open(['route' => 'branches.store', 'method' => 'post', 'files' => true, 'id' => 'branch-form']) !!}
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form__group ">

                    {!! Form::text('name', null, ['class' => 'form__field', 'placeholder' => __('lang.name'), 'required']) !!}
                    {!! Form::label('name', __('lang.name') . '*', [
                        'class' => 'form__label',
                    ]) !!}
                    @error('name')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form__group">

                    {!! Form::text('location', null, ['class' => 'form__field', 'placeholder' => __('lang.location')]) !!}
                    {!! Form::label('location', __('lang.location'), [
                        'class' => 'form__label',
                    ]) !!}
                    @error('location')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">

                <div class="form__group">

                    {!! Form::text('phone_number', null, ['class' => 'form__field', 'placeholder' => __('lang.phone_number')]) !!}
                    {!! Form::label('phone_number', __('lang.phone_number'), [
                        'class' => 'form__label',
                    ]) !!}
                    @error('phone_number')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">

                <div class="form__group">

                    {!! Form::text('email', null, ['class' => 'form__field', 'placeholder' => __('lang.email')]) !!}
                    {!! Form::label('email', __('lang.email'), [
                        'class' => 'form__label',
                    ]) !!}
                    @error('email')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">

                <div class="form__group">

                    {!! Form::text('manager_name', null, ['class' => 'form__field', 'placeholder' => __('lang.manager_name')]) !!}
                    {!! Form::label('manager_name', __('lang.manager_name'), [
                        'class' => 'form__label',
                    ]) !!}
                    @error('manager_name')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="form__group">

                    {!! Form::text('manager_mobile_number', null, [
                        'class' => 'form__field',
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
        <button id="create-nationality-btn" type="submit" class="p-3 submit-button">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.save')</span>
        </button>
        <button type="button" class="p-3 delete-button" onclick="toggleModal()">
            <span class="transition"></span>
            <span class="gradient"></span>
            <span class="label">@lang('lang.close')</span>
        </button>
    </div>
    {!! Form::close() !!}
</div>


{{-- {!! JsValidator::formRequest('App\Http\Requests\StoreOpeningRequest','#opening-form'); !!} --}}
