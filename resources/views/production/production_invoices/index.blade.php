@extends('layouts.app')
@section('title', 'عرض فواتير الانتاج')
@section('breadcrumbbar')
    <div class="breadcrumbbar">
        {{-- ///////// left side //////////// --}}
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">عرض  فواتير الانتاج</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">@lang('lang.dashboard')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">عرض فواتير الانتاج</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="table-responsive">
                                        <table id="datatable-buttons" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>رقم الفاتورة</th>
                                                    <th>التاريخ والوقت</th>
                                                    <th>تاريخ الفاتورة</th>
                                                    <th>@lang('lang.customer')</th>
                                                    <th>@lang('lang.created_by')</th>
                                                    <th class="sum">قيمة</th>
                                                    <th class="sum">المبلغ المدفوع</th>
                                                    <th class="sum">المبلغ المتبقي للعميل</th>
                                                    <th class="sum">المتاخرات</th>
                                                    <th class="notexport">@lang('lang.action')</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tbody">
                                                @foreach($productionInvoices as $index => $invoice)
                                                    <tr>
                                                        <td>{{ $index+1 }}</td>
                                                        <td>{{$invoice->invoice_no ?? ''}}</td>
                                                        <td>{{$invoice->created_at }}</td>
                                                        <td>{{@format_date($invoice->transaction_date) }}</td>
                                                        <td>{{$invoice->customer->name??''}}</td>
                                                        <td>{{ $invoice->created_by_user->name }}</td>
                                                        <td>{{ @num_format($invoice->grand_total) }}</td>
                                                        @php
                                                            $paid = 0;
                                                            $payments = $invoice->transaction_payments;
                                                            foreach ($payments as $payment)
                                                            {
                                                                $paid += $payment->customer_paid;
                                                            }
                                                        @endphp
                                                        <td>
                                                            {{ @num_format($paid) }}
                                                        </td>
                                                        <td>
                                                            {{ @num_format($payment->customer_rest) }}
                                                        </td>
                                                        <td>
                                                            {{ @num_format($invoice->grand_total - $paid) }}
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                @lang('lang.action')
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                                                {{-- ++++++++++++ invoice dues : الفواتير المتاخرة ++++++++++++ --}}
                                                                    @php
                                                                        $invoice_has_dues = App\Models\ProductionTransaction::where(['id' => $invoice->id,'payment_status' => 'partial'])->count();
                                                                    @endphp
                                                                    @if( $invoice_has_dues > 0 )
                                                                        <li>
                                                                            <a href="#" class="btn btn-modal pay-due-link" data-due-id="{{ $invoice->id }}">
                                                                                <i class="dripicons-document-edit"></i> @lang('lang.pay_due')
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    @include('production.production_invoices.due_modal')
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('javascripts')
    <script src="{{ asset('js/custom/custom_production/production_js.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.pay-due-link').on('click', function (e) {
                e.preventDefault();

                // "product_transaction" id
                var dueId = $(this).data('due-id');
                console.log("dueId = "+dueId);
                // Make an AJAX request to the pay_due_view route
                $.ajax({
                    url: "{{ url('ar/production_invoices/pay_due_view') }}/" + dueId,
                    method: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        console.log(response);
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
@endpush
