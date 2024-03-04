<div class="row row_weight align-items-center">
    <div class="col-md-1 text-center mt-3">
        <button type="button"
            style="{{ (isset($hideBtn) && $hideBtn != 2) || (isset($index) && $index !== 0) ? 'display:none;' : '' }}"
            class="plus add_row">
            <span class="inner"></span>
            <i class="fa fa-plus"></i></button>
    </div>
    <div class="col-md-2 ">
        <input type="hidden" name="opening_request_id[]"
            value="{{ isset($Opening_request_nat->id) ? $Opening_request_nat->id : null }}" />
        {!! Form::label('nationality_id', __('lang.nationality') . '*', [
            'class' => 'form-label ',
            'style' => isset($hideBtn) ? 'display:none;' : '',
        ]) !!}
        {!! Form::select(
            'nationality_id[]',
            $nationalities,
            isset($Opening_request_nat->nationality_id) ? $Opening_request_nat->nationality_id : null,
            [
                'class' => 'form-control selectpicker',
                'data-live-search' => 'true',
                'placeholder' => __('lang.please_select'),
                'required',
                'style' => 'display:inline !important',
            ],
        ) !!}
    </div>

    <div class="col-md-2 ">
        <div class="form__group field">
            {!! Form::number(
                'percent[]',
                isset($Opening_request_nat->percentage)
                    ? $Opening_request_nat->percentage
                    : (isset($f_store)
                        ? $f_store->percent
                        : null),
                [
                    'class' => 'form__field percent',
                    'placeholder' => '0',
                ],
            ) !!}
            {!! Form::label('percent', __('lang.percent') . '%', [
                'class' => 'form__label percent',
                'style' => isset($hideBtn) ? 'display:none;' : '',
            ]) !!}
        </div>
    </div>
    <div class="col-md-2 ">
        <div class="form__group field">
            <input type="number" name="weight[]" class="form__field weight-input  weight nationality-weight"
                placeholder="0.00" data-nationality=""
                value="{{ isset($Opening_request_nat->weight) ? $Opening_request_nat->weight : null }}">
            <label for="weight"
                class="form__label {{ isset($hideBtn) ? 'd-none' : '' }}">{{ __('lang.weight') }}</label>
        </div>
    </div>

    <div class="col-md-1  text-center">
        <button type="button"
            style="{{ (empty($Opening_request_nat) && (!isset($hideBtn) || (isset($index) && $index == 0))) || (!empty($Opening_request_nat) && (!isset($hideBtn) && (isset($index) && $index == 0))) ? 'display:none;' : '' }}"
            class="remove remove_row"><span class="inner"></span><i class="fa fa-close"></i></button>
    </div>
</div>
@push('javascripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Function to update the weight when a nationality is selected
            $(document).on('change', 'select[name="nationality_id[]"]', function() {
                var selectedNationalityId = $(this).val();
                var weightInput = $(this).closest('.row_weight').find('input.nationality-weight');
                var percent = $(this).closest('.row_weight').find('input.percent');
                weightInput.attr('data-nationality', selectedNationalityId);

                $.ajax({
                    type: 'GET',
                    url: '/get-nationality-weight/' + selectedNationalityId,
                    success: function(response) {
                        console.log(response.weight);
                        // $('.weight-input').val(response.weight);
                        weightInput.val(response.weight).trigger('input');

                        // Calculate percentage for the specific row
                        calculatePercentageForRow(weightInput, percent);
                    }
                });
            });

            // Function to calculate the total weight based on percentage for a specific row
            function calculatePercentageForRow(weightInput, percent) {
                var row = weightInput.closest('.row_weight');
                var selectedNationalityId = weightInput.data('nationality');
                var percentInput = percent;
                var percent = parseFloat(percentInput);
                if (!isNaN(percent)) {
                    var weight = parseFloat(weightInput.val());
                    if (!isNaN(weight)) {
                        var newWeight = (percent * weight) / 100;
                        weightInput.val(newWeight.toFixed(2));
                    }
                }
            }

            // Attach percentage calculation to input[name="percent[]"] change event
            $(document).on('change', 'input[name="percent[]"]', function() {
                var percentInput = $(this);
                calculatePercentageForRow(percentInput.closest('.row_weight').find(
                    'input.nationality-weight'));
            });


        });
    </script>
@endpush
