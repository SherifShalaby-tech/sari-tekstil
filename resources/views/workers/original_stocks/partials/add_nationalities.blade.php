<div class="row row_weight align-items-center">
    <div class="col-md-1 text-center mt-3">
        <button type="button"
            style="{{ (isset($hideBtn) && $hideBtn != 2) || (isset($index) && $index !== 0) ? 'display:none;' : '' }}"
            class="plus add_row"><span class="inner"></span><i class="fa fa-plus"></i></button>
    </div>
    <div class="col-md-2">
        {!! Form::label('nationality_id', __('lang.nationality') . '*', [
            'class' => 'form-label ',
            'style' => isset($hideBtn) ? 'display:none;' : '',
        ]) !!}
        {!! Form::select('nationality_id[]', $nationalities, isset($f_store) ? $f_store->nationality->id : null, [
            'class' => 'form-control selectpicker nationality_id',
            'data-live-search' => 'true',
            'placeholder' => __('lang.please_select'),
            'required',
        ]) !!}
    </div>
    <div class="col-md-2">
        <div class="form__group">
            {!! Form::text(
                'weight[]',
                isset($weight_product) && !empty($weight_product)
                    ? @num_format($weight_product)
                    : (isset($f_store)
                        ? $f_store->weight
                        : null),
                [
                    'class' => 'form__field weight',

                    'placeholder' => '0.00',
                ],
            ) !!}
            {!! Form::label('weight', __('lang.weight'), [
                'class' => 'form__label',
                'style' => isset($hideBtn) ? 'display:none;' : '',
            ]) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form__group">

            {!! Form::label('percent', __('lang.percent') . '%', [
                'class' => 'form__label',
                'style' => isset($hideBtn) ? 'display:none;' : '',
            ]) !!}
            {!! Form::number('percentage[]', isset($f_store) ? $f_store->percentage : null, [
                'class' => 'form__field percent',
                'placeholder' => '0',
            ]) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="form__group">

            {!! Form::label('actual_weight', __('lang.actual_weight') . '*', [
                'class' => 'form__label',
                'style' => isset($hideBtn) ? 'display:none;' : '',
            ]) !!}
            {!! Form::text('actual_weight[]', isset($f_store) ? $f_store->goods_weight : 0, [
                'class' => 'form__field actual_weight',
                'placeholder' => '0.00',
                'required',
            ]) !!}
        </div>
    </div>
    <div class="col-md-1  text-center">
        <button type="button" style="{{ !isset($hideBtn) || (isset($index) && $index == 0) ? 'display:none;' : '' }}"
            class=" remove remove_row"><i class="fa fa-close"></i></button>
    </div>
</div>
