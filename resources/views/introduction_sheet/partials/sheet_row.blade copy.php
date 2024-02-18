<tr>
    {{-- +++++++++++++++++++ car_sku +++++++++++++++++++ --}}
    <td>
        <input type="text" class="form-control text" name="sheet" placeholder="@lang('lang.car_sku')">
    </td>
    {{-- +++++++++++++++++++ process_type +++++++++++++++++++ --}}
    <td>
        {!! Form::select('sheet['.$row_index.'][process_id]', $processes, null , ['class' => 'form-control', 'placeholder' => __('lang.please_select'), 'required']) !!}
    </td>
    {{-- +++++++++++++++++++ process +++++++++++++++++++ --}}
    <td>
        {!! Form::select('sheet['.$row_index.'][process_type_id]', $processes, null , ['class' => 'form-control', 'placeholder' => __('lang.please_select'), 'required']) !!}
    </td>
    {{-- +++++++++++++++++++ calibars +++++++++++++++++++ --}}
    <td>
        {!! Form::select('caliber[]', $caliber, null,
            ['class' => 'form-control select2 multiple', 'placeholder' => __('lang.please_select'), 'data-live-search' => 'true', 'required', 'multiple' => 'multiple']
        ) !!}
    </td>
    {{-- +++++++++++++++++++ car_barcode +++++++++++++++++++ --}}
    <td>
        <input type="text" class="form-control text" name="car_barcode" placeholder="@lang('lang.car_barcode')">
    </td>
    {{-- +++++++++++++++++++ Actions +++++++++++++++++++ --}}
    <td>
        {{-- ======== delete_row button ======== --}}
        <div class="col-2">
            <a href="javascript:void(0)" class="btn btn-xs btn-danger deleteRow">
                <i class="fa fa-close"></i>
            </a>
        </div>
        {{-- ======== print button ======== --}}
        <div class="col-2">
            <a href="#">
                <i class="fa fa-print"></i>
            </a>
        </div>
    </td>
</tr>
