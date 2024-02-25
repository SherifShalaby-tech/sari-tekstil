@extends('layouts.app')
@section('title', "متاخرات العميل")
@section('breadcrumbbar')
    <div class="breadcrumbbar">
       <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <h4 class="page-title">متاخرات العميل</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">@lang('lang.dashboard')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('lang.due')</li>
                    </ol>
                </div>
            </div>
            {{-- <div class="col-md-4 col-lg-4">

                <div class="widgetbar">
                    <a href="{{route('products.create')}}" class="btn btn-primary">
                        @lang('lang.add_products')
                      </a>
                </div>
            </div> --}}
   </div>
    </div>
@endsection
@section('content')
    {{-- <!-- Start row -->
    <div class="row d-flex justify-content-center">
        <!-- Start col -->
        <div class="col-lg-12">
            <div class="card m-b-30 p-2">


            </div>
        </div>
    </div> --}}
       <!-- Start Contentbar -->
       <div class="contentbar">
        <!-- Start row -->
        <div class="row">
            <!-- Start col -->
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">@lang('lang.due')</h5>
                    </div>
                    <div class="card-body">
                        {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel & Note.</h6> --}}
                        <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('lang.date')</th>
                                    <th>المرجعي</th>
                                    <th>@lang('lang.customer')</th>
                                    <th>المبلغ</th>
                                    <th>@lang('lang.paid')</th>
                                    <th>متاخرات</th>
                                    <th>الخيارات</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1 ;
                                    @endphp
                                    @foreach ($dues as $due)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{@format_date($due->transaction_date)}}</td>
                                        <td> {{$due->invoice_no}}</td>
                                        <td> {{$due->customer->name ?? ''}}</td>
                                        <td> {{@num_format($due->grand_total)}}</td>
                                        <td> {{@num_format($due->transaction_payments->sum('customer_paid'))}}</td>
                                        {{-- due : المتاخرات --}}
                                        <td> {{ $due->grand_total - $due->transaction_payments->sum('customer_paid') }}</td>
                                        @if($due->payment_status == 'partial')
                                            <td class="col18">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">خيارات
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(73px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                        <li>
                                                            {{-- <a  data-href="{{route('customers.pay_due_view', ['id' => $due->id])}}" class="btn" data-toggle="modal" data-target="#editModal">
                                                                <i class="dripicons-document-edit"></i> @lang('lang.pay_due')
                                                            </a> --}}
                                                            <a href="#" class="btn btn-modal pay-due-link" data-due-id="{{ $due->id }}">
                                                                <i class="dripicons-document-edit"></i> @lang('lang.pay_due')
                                                            </a>
                                                        </li>
                                                        {{-- <li class="divider"></li>
                                                            <li>
                                                                <a data-href="{{route('customers.destroy', $customer->id)}}"
                                                                    class="btn text-red delete_item"><i class="fa fa-trash"></i>
                                                                    @lang('lang.delete')</a>
                                                        </li> --}}
                                                    </ul>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                        @include('customers.due_modal')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
        <!-- End row -->
    </div>
    <!-- End Contentbar -->
    <div class="view_modal no-print" >

    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('.pay-due-link').on('click', function (e) {
            e.preventDefault();

            // "product_transaction" id
            var dueId = $(this).data('due-id');
            console.log("dueId = "+dueId);
            // Make an AJAX request to the pay_due_view route
            $.ajax({
                url: "{{ url('ar/pay_due_view') }}/" + dueId,
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    // production_transaction_id
                    $('#editModal').find('.production_transaction_id').val(dueId);
                    // customer_id
                    $('#editModal').find('.customer_id').val(response.customer_id);
                    // dueAmount
                    $('#editModal').find('.dueAmount').val(response.dueAmount);
                    // last_customer_paid
                    $('#editModal').find('.last_customer_paid').val(response.customer_paid);
                    // Show the modal
                    $('#editModal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching dueAmount: " + error);
                }
            });
        });
    });
</script>


