<div class="row row_weight">
    {{-- <div class="col-md-1 pt-4 text-center"> --}}
        {{-- <button type="button" style="{{ (isset($hideBtn)&& $hideBtn!=2)||(isset($index)&&$index!==0) ? 'display:none;' : '' }}"
            class="btn btn-primary btn-sm ml-2 add_row"><i class="fa fa-plus"></i></button> --}}
    {{-- </div> --}}
    <div class="col-md-2 pt-3">
        <input type="hidden" name="opening_id[]" value="{{$nationality->id}}"/>
        {!! Form::label('car_id', __('lang.sku')."*", ['class' => 'h6 ', 'style'=>(isset($index)&& $index!=0) ? 'display:none;' : '']) !!}
        {!! Form::select('car_id[]',$cars, isset($nationality->car_id)?$nationality->car_id:null, [
            'class' => 'form-control selectpicker','data-live-search'=>"true",
            'placeholder' => __('lang.sku'),
            'required'
        ]) !!}
    </div>
    <div class="col-md-2 pt-3">
        {!! Form::label('nationality_id', __('lang.nationality')."*", ['class' => 'h6 ', 'style'=>(isset($index)&& $index!=0)? 'display:none;' : '']) !!}
        {!! Form::text('nationality_id[]', isset($nationality)?$nationality->nationality->name:null, [
            'class' => 'form-control ',
            'placeholder' => __('lang.please_select'),
            'required','disabled'
        ]) !!}
    </div>
    <div class="col-md-2 pt-3">
        {!! Form::label('weight', __('lang.weight'), ['class' => 'h6', 'style'=>(isset($index)&& $index!=0)? 'display:none;' : '']) !!}
        {!! Form::number('weight[]',isset($nationality)?$nationality->weight:null, [
            'class' => 'form-control weight',
            'placeholder' => '0.00','disabled'
        ]) !!}
    </div>
    <div class="col-md-2 pt-3">
        {!! Form::label('percentage', __('lang.percent') . '%', ['class' => 'h6', 'style'=>(isset($index)&& $index!=0) ? 'display:none;' : '']) !!}
        {!! Form::number('percentage[]', isset($nationality)?@num_format($nationality->percentage):null, [
            'class' => 'form-control percent',
            'placeholder' => '0','disabled'
        ]) !!}
    </div>
    <div class="col-md-2 pt-3">
        {!! Form::label('goods_weight', __('lang.goods_weight')."*", ['class' => 'h6', 'style'=>(isset($index)&& $index!=0) ? 'display:none;' : '']) !!}
        {!! Form::text('goods_weight[]', isset($nationality->goods_weight)?$nationality->goods_weight:0, [
            'class' => 'form-control goods_weight',
            'placeholder' => '0.00',
            'required'
        ]) !!}
    </div>
</div>
