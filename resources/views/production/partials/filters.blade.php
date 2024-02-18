<div class="card-body">
    <form action="{{route('production.index')}}" method="get" id="filters_form">
        <div class="row">
            {{-- +++++++++++++++++ نوع التعبئة +++++++++++++++++ --}}
            {{-- <div class="col-2">
                <div class="form-group">
                    {!! Form::label('packing_type','نوع التعبئة', []) !!}
                    {!! Form::select('packing_type', $packing_types,null, ['class' => 'form-control select2 packing_type','placeholder'=>__('lang.please_select'),'id' => 'packing_type']
                    ) !!}
                </div>
            </div> --}}
            {{-- +++++++++++++++ color filter +++++++++++++++ --}}
            <div class="col-2">
                <div class="form-group">
                    {!! Form::label('color_id','اللون', []) !!}
                    {!! Form::select('color_id', $colors,request()->color_id, ['class' => 'form-control select2 colors','placeholder'=>__('lang.please_select'),'id' => 'color_id']
                    ) !!}
                </div>
            </div>
            {{-- +++++++++++++++ start_date filter +++++++++++++++ --}}
            <div class="col-2">
                <div class="d-flex align-items-center gap-2 flex-wrap flex-lg-nowrap">
                    <div class="w-100">
                        {!! Form::label('start_date', "من تاريخ", []) !!}
                        {!! Form::date('start_date',request()->start_date, ['class' => 'form-control start_date w-100']) !!}
                    </div>
                </div>
            </div>
            {{-- +++++++++++++++ end_date filter +++++++++++++++ --}}
            <div class="col-2">
                <div class="d-flex align-items-center gap-2 flex-wrap flex-lg-nowrap">
                    <div class="w-100">
                        {!! Form::label('end_date',  "الي تاريخ", []) !!}
                        {!! Form::date('end_date',request()->end_date, ['class' => 'form-control end_date w-100']) !!}
                    </div>
                </div>
            </div>
            {{-- +++++++++++++++ current_content filter +++++++++++++++ --}}
            {{-- <div class="col-2">
                <div class="form-group">
                    {!! Form::label('current_content','المحتوي الحالي', []) !!}
                    {!! Form::select('current_content', $current_content,null, ['class' => 'form-control select2 current_content','placeholder'=>__('lang.please_select'),'id' => 'current_content']
                    ) !!}
                </div>
            </div> --}}
            {{-- +++++++++++++++ caliber filter +++++++++++++++ --}}
            <div class="col-2">
                <div class="form-group">
                    {!! Form::label('caliber','العيار', []) !!}
                    {!! Form::select('caliber', $calibers,request()->caliber, ['class' => 'form-control select2 caliber','placeholder'=>__('lang.please_select'),'id' => 'caliber']
                    ) !!}
                </div>
            </div>
            {{-- ++++++++++++++++++ "filter" and "clear filters" button ++++++++++++++++++ --}}
            <div class="col-2">
                <div class="d-flex align-items-center gap-2 mt-4">
                        {{-- ======= "filter" button ======= --}}
                        <button type="submit" id="filter_btn" class="btn btn-primary m-2" title="search">
                            <i class="fa fa-eye"></i> {{ __('lang.filter') }}
                        </button>
                        {{-- ======= clear "filters" button ======= --}}
                        <a href="{{ route('production.index') }}" class="btn btn-danger m-2 clear_filters">الغاء التصفية</a>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {

    });
</script>

