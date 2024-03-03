<div class="row row_weight">
    <div class="col-md-1 pt-4 text-center">
        <button type="button" style="{{ (isset($hideBtn)&& $hideBtn!=2)||(isset($index)&&$index!==0) ? 'display:none;' : '' }}"
            class="btn btn-primary btn-sm ml-2 add_row"><i class="fa fa-plus"></i></button>
    </div>
    <div class="col-md-2 pt-3">
        {!! Form::label('nationality_id', __('lang.nationality')."*", ['class' => 'h6 ', 'style'=>isset($hideBtn) ? 'display:none;' : '']) !!}
        {!! Form::select('nationality_id[]', $nationalities, isset($f_store)?$f_store->nationality->id:null, [
            'class' => 'form-control selectpicker nationality_id','data-live-search'=>"true",
            'placeholder' => __('lang.please_select'),
            'required'
        ]) !!}
    </div>
    <div class="col-md-2 pt-3">
        {!! Form::label('weight', __('lang.weight'), ['class' => 'h6', 'style'=>isset($hideBtn) ? 'display:none;' : '']) !!}
        {!! Form::text('weight[]',isset($weight_product)&&!empty($weight_product)?@num_format($weight_product):(isset($f_store)?$f_store->weight:null), [
            'class' => 'form-control weight',

            'placeholder' => '0.00',
        ]) !!}
    </div>
    <div class="col-md-2 pt-3">
        {!! Form::label('percent', __('lang.percent') . '%', ['class' => 'h6', 'style'=>isset($hideBtn) ? 'display:none;' : '']) !!}
        {!! Form::number('percentage[]', isset($f_store)?$f_store->percentage:null, [
            'class' => 'form-control percent',
            'placeholder' => '0',
        ]) !!}
    </div>
    <div class="col-md-2 pt-3">
        {!! Form::label('actual_weight', __('lang.actual_weight')."*", ['class' => 'h6', 'style'=>isset($hideBtn) ? 'display:none;' : '']) !!}
        {!! Form::text('actual_weight[]', isset($f_store)?$f_store->goods_weight:0, [
            'class' => 'form-control actual_weight',
            'placeholder' => '0.00',
            'required'
        ]) !!}
    </div>
    <div class="col-md-1 pt-3 text-center">
        <button type="button" style="{{ !isset($hideBtn)||(isset($index)&&$index==0) ? 'display:none;' : '' }}"
            class="btn btn-danger btn-sm ml-2 remove_row"><i class="fa fa-close"></i></button>
    </div>
</div>
