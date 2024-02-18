<!-- introduction_sheet.partials.sheet_row.blade.php -->

<tr>
    {{-- +++++++++++++++++++ car_sku +++++++++++++++++++ --}}
    <td>
        <div class="form-group">
            <input type="text" class="form-control text" name="car_sku[]" placeholder="@lang('lang.car_sku')" required>
            @error('car_sku')
                <label class="text-danger error-msg">{{ $message }}</label>
            @enderror
        </div>
    </td>
    {{-- +++++++++++++++++++ process_type +++++++++++++++++++ --}}
    <td>
        <div class="form-group">
            {!! Form::select('process_type[]', $processes, null,
                ['class' => 'form-control select2 process_type', 'placeholder' => __('lang.please_select'), 'data-live-search' => 'true', 'required']) !!}
        </div>
    </td>
    {{-- +++++++++++++++++++ process +++++++++++++++++++ --}}
    <td>
        <div class="form-group">
            {!! Form::select('process[]', [] , null,
                ['class' => 'form-control select2 process', 'placeholder' => __('lang.please_select'), 'data-live-search' => 'true', 'required']) !!}
        </div>
    </td>
    {{-- +++++++++++++++++++ calibars +++++++++++++++++++ --}}
    <td>
        <div class="form-group">
            {!! Form::select('caliber[]', $caliber, null,
                ['class' => 'form-control select2', 'placeholder' => __('lang.please_select'), 'data-live-search' => 'true', 'required']) !!}
        </div>
    </td>
    {{-- +++++++++++++++++++ car_barcode +++++++++++++++++++ --}}
    {{-- <td>
        <div class="form-group">
            {!! Form::text('car_barcode[]', null, ['class' => 'form-control', 'placeholder' => __('lang.car_barcode')]) !!}
            @error('car_barcode')
                <label class="text-danger error-msg">{{ $message }}</label>
            @enderror
        </div>
    </td> --}}
    {{-- +++++++++++++++++++ Actions +++++++++++++++++++ --}}
    <td>
        {{-- ======== delete_row button ======== --}}
        <div class="col-2">
            <a href="javascript:void(0)" class="btn btn-xs btn-danger deleteRow">
                <i class="fa fa-close"></i>
            </a>
        </div>
        {{-- ======== print button ======== --}}
        {{-- <div class="col-2">
            <a href="#">
                <i class="fa fa-print"></i>
            </a>
        </div> --}}
    </td>
</tr>

<!-- Add the following script at the end of your HTML page or in your JavaScript file -->
<script>
    $(document).ready(function(){
        // ++++ select2 ++++
        $('.select2').select2();
        // Dynamically update the "process" dropdown based on the selected "process_type"
        $('.process_type').on('change', function(){
            var processTypeVal = $(this).val();
            var processDropdown = $(this).closest('tr').find('.process');

            processDropdown.html('');
            $.ajax({
                url: "/fetch-processes",
                type: 'POST',
                dataType: 'json',
                data: { process_type_val: processTypeVal , _token:"{{ csrf_token() }}" },
                success:function(response)
                {
                    console.log(response);
                    var pleaseSelect = "{{ __('lang.please_select') }}";
                    processDropdown.html('<option value="">' + pleaseSelect + '</option>');

                    $.each(response.process_type_val, function(index, val)
                    {
                        processDropdown.append('<option value="'+index+'">'+val+'</option>');
                    });
                }
            });
        });
    });
</script>
