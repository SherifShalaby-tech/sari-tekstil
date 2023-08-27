<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
</head>

<body style="background-color:transparent !important;">
    <style>
        @media print {
            * {
                font-size: 12px;
                line-height: 20px;
                font-family: 'Times New Roman';
                background-color: transparent !important;
            }

            td,
            th {
                padding: 5px 0;
            }

            .hidden-print {
                display: none !important;
            }

            #payment_table_view {
                background: transparent !important;
            }

            table tr td,
            table tr th {
                background-color: rgba(210, 130, 240, 0.3) !important;
            }

            #watermark {
                position: fixed;
                width: 100%;
                height: auto;
                top: 10%;
                left: 0%;
                opacity: 0.2;
            }

            #watermark img {
                width: 100%;
                height: 100%;
            }

            #header_invoice_img {
                margin: auto;
            }

            #invoice_heaer_div {
                width: 100%;
            }

        }

        #receipt_section * {
            font-size: 14px;
            line-height: 24px;
            font-family: 'Ubuntu', sans-serif;
            text-transform: capitalize;
            color: black !important;
        }

        #receipt_section .btn {
            padding: 7px 10px;
            text-decoration: none;
            border: none;
            display: block;
            text-align: center;
            margin: 7px;
            cursor: pointer;
        }

        #receipt_section .btn-info {
            background-color: transparent !important;
            color: #FFF;
        }

        #receipt_section .btn-primary {
            background-color: #6449e7;
            color: #FFF;
            width: 100%;
        }

        #receipt_section td,
        #receipt_section th,
        #receipt_section tr,
        #receipt_section table {
            border-collapse: collapse;
        }

        #receipt_section tr {
            border-bottom: 1px dotted #ddd;
        }

        #receipt_section td,
        #receipt_section th {
            padding: 7px 0;
            width: 50%;
        }

        #receipt_section table {
            width: 100%;
        }

        #receipt_section tfoot tr th:first-child {
            text-align: left;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        small {
            font-size: 11px;
        }

        #product_table_view.table-bordered {
            border: 1px solid #333 !important;
            margin-top: 20px;
        }

        #product_table_view.table-bordered>thead>tr>th {
            border: 1px solid #333 !important;
        }

        #product_table_view.table-bordered>tbody>tr>td {
            border: 1px solid #333 !important;
        }

        #payment_table_view.table-bordered {
            border: 1px solid #333 !important;
            margin-top: 20px;
        }

        #payment_table_view.table-bordered>thead>tr>th {
            border: 1px solid #333 !important;
        }

        #payment_table_view.table-bordered>tbody>tr>td {
            border: 1px solid #333 !important;
        }

    </style>
    @if (empty($create_pdf))
        <style>
            @media print {

                @page {
                    size: A4;
                    margin-top: 0px;
                    margin-bottom: 40px;
                }

                body * {
                    background-color: transparent !important;
                }
            }

        </style>
    @endif
    @if (!empty($create_pdf))
        <style>
            .col-xs-1,
            .col-sm-1,
            .col-md-1,
            .col-lg-1,
            .col-xs-2,
            .col-sm-2,
            .col-md-2,
            .col-lg-2,
            .col-xs-3,
            .col-sm-3,
            .col-md-3,
            .col-lg-3,
            .col-xs-4,
            .col-sm-4,
            .col-md-4,
            .col-lg-4,
            .col-xs-5,
            .col-sm-5,
            .col-md-5,
            .col-lg-5,
            .col-xs-6,
            .col-sm-6,
            .col-md-6,
            .col-lg-6,
            .col-xs-7,
            .col-sm-7,
            .col-md-7,
            .col-lg-7,
            .col-xs-8,
            .col-sm-8,
            .col-md-8,
            .col-lg-8,
            .col-xs-9,
            .col-sm-9,
            .col-md-9,
            .col-lg-9,
            .col-xs-10,
            .col-sm-10,
            .col-md-10,
            .col-lg-10,
            .col-xs-11,
            .col-sm-11,
            .col-md-11,
            .col-lg-11,
            .col-xs-12,
            .col-sm-12,
            .col-md-12,
            .col-lg-12 {
                border: 0;
                padding: 0;
                margin-left: -0.00001;
            }

        </style>
    @endif
    @php
        $logo = App\Models\System::getProperty('logo');
    @endphp
    @if (empty($create_pdf))
        <div id="watermark"><img src="{{ asset('/uploads/' . $logo) }}" alt=""></div>
    @endif

    <div class="row header_div" id="header_div" style="width: 100%;">
        @include('layouts.partials.print_header')

    </div>
    <div class="col-md-12 content_div" id="content_div">
        <div class="row">
            <div class="col-md-6" style="width: 50%;@if (!empty($create_pdf)) float:left; @endif">
                <div class="col-md-12">
                    <h5>@lang('lang.date'): {{ now()->format('Y-m-d') }}</h5>
                    {{-- <h5>@lang('lang.store'): {{ $sale->store->name ?? '' }}</h5> --}}
                </div>
            </div>
            <br>
            {{-- <div class="col-md-6" style="width: 50%;@if (!empty($create_pdf)) float:right; @endif">
                <div class="col-md-12">
                    @lang('lang.name'): <b>{{ $sale->customer->name ?? '' }}</b>
                </div>
                <div class="col-md-12">
                    @lang('lang.email'): <b>{{ $sale->customer->email ?? '' }}</b>
                </div>
                <div class="col-md-12">
                    @lang('lang.phone'): <b>{{ $sale->customer->mobile_number ?? '' }}</b>
                </div>
                <div class="col-md-12">
                    @lang('lang.address'): <b>{{ $sale->customer->address ?? '' }}</b>
                </div>
            </div> --}}
        </div>

        <br>
        <div class="row">
            <div class="col-md-12">
                <table class="table-bordered" style="text-align: center; background-color:transparent !important;"
                    >
                    <thead class="">
                        <tr>
                            <th>@lang('lang.sku')</th>
                            <th>@lang('lang.name')</th>
                            <th>@lang('lang.recent_process')</th>
                            <th>@lang('lang.recent_car_content')</th>
                            <th>@lang('lang.recent_place')</th>
                            <th>@lang('lang.caliber')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$car->sku}}</td>
                            <td>{{$car->name}}</td>
                            <td>{{$car->process}}</td>
                            <td>{{$car->recent_car_content}}</td>
                            <td>
                                {{$car->recent_place}}
                            </td>
                            <td >{{!empty($car->caliber)?$car->caliber->number:'-'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>

</body>

</html>
