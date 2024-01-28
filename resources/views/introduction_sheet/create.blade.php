@extends('layouts.app')
@section('title', __('lang.add_introduction_sheet'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <div class="media">
                    <span class="breadcrumb-icon"><i class="ri-store-2-fill"></i></span>
                    <div class="media-body">
                        <h4 class="page-title">@lang('lang.add_introduction_sheet')</h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('lang.dashboard')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('lang.add_introduction_sheet')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ++++++++++++++++ Add Button ++++++++++++++++ --}}
         <div class="col-md-3  col-lg-3 d-flex mt-3">
            <div class="widgetbar">
                <a href="{{route('introduction-sheet.index')}}" class="btn btn-primary pull-right" target="_blank">
                    @lang('lang.show')</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="contentbar">
        <div class="row">
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">@lang('lang.add_introduction_sheet')</h5>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'introduction-sheet.store', 'method' => 'post', 'files' => true,'id' =>'introduction-sheet-form' ]) !!}
                        {{-- "index" of "each row" --}}
                        <input type="hidden" name="index" id="index" value="0">
                        {{-- +++++++++++ add_new_row button +++++++++++ --}}
                        <div class="row">
                            {{-- add "new_row" to table --}}
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary add_row" id="add_row">
                                    <i class="fa fa-plus"></i> @lang('lang.add_row')
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="sheet_table">
                                {{-- /////////// table_thead /////////// --}}
                                <thead>
                                    <tr>
                                        <th>@lang('lang.car_sku')</th>
                                        <th>@lang('lang.process_type'):<span style="color:#f00;">*</span></th>
                                        <th>@lang('lang.process'):<span style="color:#f00;">*</span></th>
                                        <th>@lang('lang.caliber'):<span style="color:#f00;">*</span></th>
                                        {{-- <th>@lang('lang.car_barcode')</th> --}}
                                        <th>@lang('lang.action')</th>
                                    </tr>
                                </thead>
                                {{-- /////////// table_tbody /////////// --}}
                                <tbody class="table_tbody">
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
                                                {!! Form::select('process_type[]', $processes, null ,
                                                ['class' => 'form-control select2', 'id'=>'process_type_id', 'placeholder' => __('lang.please_select'),'data-live-search' => 'true', 'required']) !!}
                                                @error('process_type')
                                                    <label class="text-danger error-msg">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </td>
                                        {{-- +++++++++++++++++++ process +++++++++++++++++++ --}}
                                        <td>
                                            <div class="form-group">
                                                {!! Form::select('process[]', [], null ,
                                                ['class' => 'form-control select2', 'id' => 'process_id' , 'placeholder' => __('lang.please_select'),'data-live-search' => 'true', 'required']) !!}
                                                @error('process')
                                                    <label class="text-danger error-msg">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </td>
                                        {{-- +++++++++++++++++++ calibars +++++++++++++++++++ --}}
                                        <td>
                                            <div class="form-group">
                                                {!! Form::select('caliber[]', $caliber, null ,
                                                ['class' => 'form-control select2 multiple', 'placeholder' => __('lang.please_select'),'data-live-search' => 'true', 'required']) !!}
                                                @error('caliber')
                                                    <label class="text-danger error-msg">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </td>
                                        {{-- +++++++++++++++++++ car_barcode +++++++++++++++++++ --}}
                                        {{-- <td>
                                            <div class="form-group">
                                                {!! Form::text('car_barcode[]', null, ['class' => 'form-control', 'placeholder' => __( 'lang.car_barcode' )]); !!}
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
                                </tbody>
                            </table>
                        </div>
                        {{-- /////////// save button /////////// --}}
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-primary" value="@lang('lang.save')"
                                    name="submit">
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @section('javascript') --}}
    {{-- ++++++++++++++ jquery ++++++++++++++ --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
           // +++++++++++++ add "new_row" to table +++++++++++++
            $('#add_row').click(function(){
                row_index = parseInt($('#index').val());
                row_index = row_index + 1;
                $('#index').val(row_index);
                $.ajax({
                    method: 'get',
                    url: '/introduction-sheet/get-sheet-row/'+row_index,
                    data: {  },
                    contentType: 'html',
                    success: function(result) {
                        console.log("result = "+result);
                        $('#sheet_table tbody').append(result);
                    },
                });
            });
            // +++++++++++++ remove "row" to table +++++++++++++
            $('#sheet_table').on('click', '.deleteRow', function(){
                if ($('#sheet_table tr').length > 1)
                {
                    $(this).closest('tr').remove();
                }
            });
            // +++++++++++ process dropdown ++++++++++++
            $("#process_type_id").on('change', function(){
                process_type_val = $('#process_type_id').val();
                $('#process_id').html('');
                $.ajax({
                    url: "/fetch-processes",
                    type: 'POST',
                    dataType: 'json',
                    data: { process_type_val : process_type_val , _token:"{{ csrf_token() }}" },
                    success:function(response)
                    {
                        // Include the translated string directly in JavaScript
                        var pleaseSelect = "{{ __('lang.please_select') }}";
                        $('#process_id').html('<option value="">' + "{{ __('lang.please_select') }}" + '</option>');

                        $.each(response.process_type_val,function(index, val)
                        {
                            console.log(val);
                            console.log(index);
                            $('#process_id').append('<option value="'+val+'">'+val+'</option>')
                            // console.log(val);
                        });
                    }
                });
            });
        });
    </script>
{{-- @endsection --}}
