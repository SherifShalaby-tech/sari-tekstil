@extends('layouts.app')
@section('title', __('lang.introduction_sheet'))
@section('breadcrumbbar')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        <div class="row align-items-center">
            <div class="col-md-9 col-lg-9">
                <div class="media">
                    <span class="breadcrumb-icon">
                        <i class="fa fa-file-invoice"></i>
                    </span>
                    <div class="media-body">
                        <h4 class="page-title">معاينه فاتورة ورقة تعريفية</h4>
                    </div>
                    <style>
                        @media print {
                            #print_Button {
                                display: none;
                            }
                        }

                    </style>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbbar -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class="main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h2 class="invoice-title">فاتورة ورقة تعريفية</h2>
                        </div><!-- invoice-header -->
                        <div class="row">
                            {{-- <div class="col-md">
                                <label class="tx-gray-600">Billed To</label>
                                <div class="billed-to">
                                    <h6>Juan Dela Cruz</h6>
                                    <p>4033 Patterson Road, Staten Island, NY 10301<br>
                                        Tel No: 324 445-4544<br>
                                        Email: youremail@companyname.com</p>
                                </div>
                            </div> --}}
                            <div class="col-md">
                                <label class="tx-gray-600">معلومات الفاتورة</label>
                                <p class="invoice-info-row"><span>كود العربة : </span>
                                    <span>{{ $introductionSheet->car_sku }}</span></p>
                                <p class="invoice-info-row"><span>نوع العملية : </span>
                                    <span>{{ $introductionSheet->process_type }}</span></p>
                                <p class="invoice-info-row"><span>العملية : </span>
                                    <span>{{ $introductionSheet->process }}</span></p>
                                <p class="invoice-info-row"><span>العيار : </span>
                                    <span>{{ $introductionSheet->caliber }}</span></p>
                                <p class="invoice-info-row">
                                    <span>باركود العربة : </span>
                                    <span>
                                        {!! DNS1D::getBarcodeHtml("$introductionSheet->car_barcode", 'UPCA', 3, 50, 'black') !!}
                                        {{ $introductionSheet->car_barcode }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        {{-- ++++++++++++++++ print Button ++++++++++++  --}}
                        <div class="col-12 pull-right">
                            <button class="btn btn-danger float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
                                <i class="mdi mdi-printer"></i>طباعة
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
{{-- @push('js') --}}
    <!--Internal  Chart.bundle js -->
    {{-- <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script> --}}


    <script>
        function printDiv()
        {
            console.log("00000000000000000000");
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

    </script>

{{-- @endpush --}}
