@php
    $stores = App\Models\Store::pluck('name', 'id');
@endphp
<!-- Modal -->
<div class="overlay" onclick="closeModal()"></div>
<div id="form-panel" class="form-panel off">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleStandardModalLabel">{{ __('lang.add') }}</h5>
        <button type="button" class="modal_close" onclick="toggleModal()" aria-label="Close">
            <span class="cross" aria-hidden="true"></span>
        </button>
    </div>
    {!! Form::open(['route' => 'calibers.store', 'method' => 'post', 'files' => true, 'id' => 'car-form']) !!}
    <div class="modal-body">
        <div class="row ">
            <div class="col-md-6 d-flex align-items-end">
                <div class="form__group">
                    {{-- <input type="hidden" name="quick_add" value="{{ isset($quick_add)&&$quick_add?$quick_add:'' }}"> --}}
                    {!! Form::text('number', null, ['class' => 'form__field', 'placeholder' => __('lang.number'), 'required']) !!}
                    {!! Form::label('number', __('lang.number') . '*', [
                        'class' => 'form__label',
                    ]) !!}
                    @error('number')
                        <label class="text-danger error-msg">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-0">

                    {!! Form::label('store', __('lang.store') . '*', [
                        'class' => 'form-label',
                        'style' => 'height:16px',
                    ]) !!}
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
