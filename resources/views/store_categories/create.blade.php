@php
    $branches = App\Models\Branch::pluck('name', 'id');
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
    {!! Form::open(['route' => 'storecategories.store', 'method' => 'post', 'files' => true, 'id' => 'branch-form']) !!}
    <div class="modal-body">
        <div class="form__group mb-3">
            {!! Form::text('name', null, ['class' => 'form__field', 'placeholder' => __('lang.name'), 'required']) !!}
            {!! Form::label('name', __('lang.name') . '*', [
                'class' => 'form__label',
            ]) !!}
            @error('name')
                <label class="text-danger error-msg">{{ $message }}</label>
            @enderror
        </div>
        <div class="form-group mb-3">

            {!! Form::label('branch', __('lang.branch') . '*', ['class' => 'form-label', 'style' => 'height:16px']) !!}
            {!! Form::select('branch_id', $branches, false, [
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
        <div class="form-group mb-3">

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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Triggered when the branch dropdown value changes
        $('#branch_id').change(function() {
            // Get the selected branch ID
            var branchId = $(this).val();

            // Make an AJAX request to get the stores based on the selected branch
            $.ajax({
                url: '/getStores/' +
                    branchId, // Replace with the actual route for fetching stores
                type: 'GET',
                success: function(data) {
                    // Clear existing options in the store dropdown
                    $('#store_id').empty();
                    console.log(data);
                    // Add the new options based on the received data
                    $.each(data, function(key, value) {
                        $('#store_id').append('<option value="' + key + '">' +
                            value + '</option>');
                    });

                    // Refresh the SelectPicker to reflect the changes
                    $('#store_id').selectpicker('refresh');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>

{{-- {!! JsValidator::formRequest('App\Http\Requests\StoreOpeningRequest','#opening-form'); !!} --}}
