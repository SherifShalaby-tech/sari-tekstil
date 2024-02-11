@extends('layouts.app')
@section('title', 'فاتورة انتاج')
@section('breadcrumbbar')
    <div class="breadcrumbbar">
        {{-- ///////// left side //////////// --}}
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">فاتورة انتاج</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">@lang('lang.dashboard')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">فاتورة انتاج</li>
                </ol>
            </div>
        </div>
    </div>
    <style>
        body
        {
            height: 2000px;
        }
    </style>
    @endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <!-- Move the form outside of tbody -->
                                <form method="post" action="{{ route('production.invoice.store_invoice') }}" id="table_form">
                                    @csrf
                                    @method('post')
                                    <table id="datatable-buttons" class="table table-striped table-bordered">
                                        <thead class="thead">
                                            <tr>
                                                <th class="col3">المحتوي الحالي</th>
                                                <th class="col4">نوع التعبئة</th>
                                                <th class="col5">الوزن</th>
                                                <th class="col6">اللون</th>
                                                <th class="col7">سعر البيع</th>
                                                <th class="col8">العدد</th>
                                                <th class="col9">المجموع الفرعي</th>
                                            </tr>
                                        </thead>
                                        <tbody id="invoices_table_body">
                                            @foreach ($productions as $index => $product)
                                                {{-- Check if the checkbox is checked --}}
                                                {{-- {{ dd($product) }} --}}

                                                @if (isset($product['checkbox']) && $product['checkbox'] == 1)
                                                    <tr>
                                                        {{-- ++++++ production_id ++++++ --}}
                                                        <input type="hidden" class="form-control" name="products[{{$index}}][production_id]" value="{{ $product['production_id'] }}">
                                                        {{-- ++++++ current_content ++++++ --}}
                                                        <td>
                                                            <input type="hidden" name="products[{{ $index }}][current_content]" value="{{$product['current_content']}}">
                                                            {{ $product['current_content'] }}
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="products[{{ $index }}][packing_type]" value="{{$product['packing_type']}}">
                                                            {{ $product['packing_type'] }}
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="products[{{ $index }}][weight]" value="{{$product['weight']}}">
                                                            {{ $product['weight'] }}
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="products[{{ $index }}][color_id]" value="{{$product['color_id']}}">
                                                            {{ $product['color_id'] }}
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="products[{{ $index }}][sell_price]" value="{{$product['sell_price']}}">
                                                            {{ $product['sell_price'] }}
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="products[{{ $index }}][quantity]" value="{{$product['quantity']}}">
                                                            {{ $product['quantity'] }}
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="products[{{ $index }}][total_cost]" value="{{$product['total_cost']}}">
                                                            {{ $product['total_cost'] }}
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <td colspan="5"></td>
                                            <td class="text-center">الاجمالي</td>
                                            <td class="sum_total_cost">
                                                <input type="number" class="form-control" name="sum_total_cost" readonly id="sum_total_cost" value="{{ $sum_total_cost }}" />
                                            </td>
                                        </tfoot>
                                    </table>
                                    <div class="row">
                                        {{-- ++++++++++++++++ customer info ++++++++++ --}}
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-info" id="cutomer_info_btn">بيانات العميل <i class="fa fa-arrow-down"></i> </button> <br/><br/>
                                            <div class="col-md-4" id="customer_info" style="display: none;">
                                                <select class="form-control select2" id="customer_select_id" name="customer_id">
                                                    <option value="">اختار عميل</option>
                                                    @foreach ( $customers as $customer )
                                                        <option value="{{ $customer->id }}" class="">{{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                                {{-- +++++++++++++++++ customer info ++++++++++++++++++++ --}}
                                                <div class="row" style="width:325% !important">
                                                    <div id="customer_details" class="row col-md-12"></div>
                                                </div>
                                            </div>
                                        </div> <br/>
                                        {{-- ++++++++++++++++ Payment info ++++++++++ --}}
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-info" id="payment_info_btn">بيانات الدفع <i class="fa fa-arrow-down"></i> </button> <br/><br/>
                                            <div class="col-md-4" id="payment_info" style="display: none;">
                                                <div class="row" style="width:325% !important;">
                                                    {{-- ///////// المبلغ المٌستلم ///////// --}}
                                                    <div class="col-md-4" >
                                                        <label for="">المبلغ المٌستلم</label> <br/>
                                                        <input type="number" class="form-control" name="customer_paid" id="customer_paid" value="0" />
                                                    </div>
                                                    {{-- ///////// مبلغ الدفع ///////// --}}
                                                    <div class="col-md-4" >
                                                        <label for="">مبلغ الدفع</label> <br/>
                                                        <input type="number" class="form-control" readonly name="amount" id="amount" value="{{ $sum_total_cost }}" />
                                                    </div>
                                                    {{-- ///////// المبلغ المتبقي ///////// --}}
                                                    <div class="col-md-4" >
                                                        <label for="" class="text-danger">المبلغ المتبقي</label> <br/>
                                                        <input type="number" class="form-control" id="rest_paid_id" name="rest_paid" readonly value="{{ $sum_total_cost }}" />
                                                    </div>

                                                </div> <br/>
                                                <div class="row" style="width:325% !important;">
                                                    {{-- ///////// paymentType Selectbox ///////// --}}
                                                    <div class="col-md-4" id="paymentType" style="">
                                                        <div class="form-group">
                                                            {!! Form::label('payment_type', __('lang.payment_type') . ':*', []) !!}
                                                            {!! Form::select('payment_type', $getPaymentTypeArray, null,
                                                            ['class' => 'form-control select2', 'data-live-search' => 'true', 'required', 'id'=> 'payment_type', 'placeholder' => __('lang.please_select'),
                                                             ]) !!}
                                                        </div>
                                                    </div>
                                                    {{-- ///////// paymentStatus Selectbox ///////// --}}
                                                    <div class="col-md-4" id="paymentStatus" style="">
                                                        <div class="form-group">
                                                            {!! Form::label('payment_status', __('lang.payment_status') . ':*', []) !!}
                                                            {!! Form::select('payment_status', $getPaymentStatusArray, null,
                                                            ['class' => 'form-control select2', 'data-live-search' => 'true', 'required', 'id'=> 'payment_status', 'placeholder' => __('lang.please_select'),
                                                             ]) !!}
                                                        </div>
                                                    </div>
                                                    {{-- ///////// payment_date : تاريخ السداد ///////// --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="payment_date">@lang('lang.payment_date')</label>
                                                            {!! Form::date('payment_date',date('Y-m-d'), ['class' => 'form-control datepicker', 'placeholder' => __('lang.payment_date')]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br/>
                                    </div> <br/>
                                    {{-- ++++++++++++++++++ notes ++++++++++++++++++++++++ --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('notes', __('lang.notes')) !!}
                                            {!! Form::textarea('notes', null, [
                                                'class' => 'form-control','rows' => '3',
                                            ]) !!}
                                            @error('notes')
                                                <label class="text-danger error-msg">{{ $message }}</label>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- +++++++++++++ save Button +++++++++++ --}}
                                    <div class="row pull-left">
                                        <div class="col-sm-12">
                                            <div class="text-left">
                                                <button type="submit" id="submit-btn" class="btn btn-primary" name="save">حفظ فاتورة</button>
                                            </div>
                                        </div>
                                    </div><br/><br/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @push('javascripts')
        <script>
            // ++++++++++++++++++++ Appear Customer Info +++++++++++++++++
            // Add click event listener to the cutomer_info_btn
            $('#cutomer_info_btn').on('click', function () {
                // Toggle the display of the customer_info div
                $('#customer_info').toggle();
            });
            // +++++++++++++++++ Get Selected Customer Info +++++++++++++++++
            $("#customer_select_id").on('change', function () {
                var customer_id = $(this).val();
                $.ajax({
                    url : "{{ route('production.invoice.getCustomerInfo') }}" ,
                    type: 'POST',
                    dataType: 'json',
                    data: { id: customer_id , _token:"{{ csrf_token() }}"},
                    success:function(response)
                    {
                        console.log(response);
                        // Clear previous data
                        $('#customer_details').empty();
                        $.each(response, function (index, val) {
                            // console.log(val);

                            // Create a Bootstrap row for each customer
                            var customerRow = $('<div class="row mx-1 my-3"></div>');

                            // Append customer details to the row
                            customerRow.append('<div class="col-md-6"><strong>Customer Name : </strong>' + val.name + '</div><br/>');
                            customerRow.append('<div class="col-md-6"><strong>Company Country : </strong>' + val.country + '</div><br/>');
                            customerRow.append('<div class="col-md-6"><strong>Company Address : </strong>' + val.company_address + '</div><br/>');
                            customerRow.append('<div class="col-md-6"><strong>Phones : </strong>' + val.phones + '</div><br/>');
                            customerRow.append('<div class="col-md-6"><strong>Emails : </strong>' + val.emails + '</div><br/>');
                            customerRow.append('<div class="col-md-6"><strong>Shipping Address : </strong>' + val.shipping_address + '</div><br/>');

                            // Append the row to the customer_details container
                            $('#customer_details').append(customerRow);
                        });
                    }
                });
            });
            // ++++++++++++++++++++ Appear Payment Info +++++++++++++++++
            // Add click event listener to the cutomer_info_btn
            $('#payment_info_btn').on('click', function () {
                // Toggle the display of the customer_info div
                $('#payment_info').toggle();
            });
            // ++++++++++++++++++++ Calculate rest +++++++++++++++++
            $("#customer_paid").on('keyup', function () {
                // Get the entered customer_paid value
                var customerPaid = parseFloat($(this).val()) || 0;

                // Get the initial amount
                var initialAmount = parseFloat($("#amount").val()) || 0;

                // Calculate the remaining amount
                var remainingAmount = initialAmount - customerPaid;

                // Update the rest_paid input
                $("#rest_paid_id").val(remainingAmount.toFixed(2));
            });
        </script>
    @endpush
