    <!-- Start css -->
    <!-- Switchery css -->
    <link href="{{ asset('plugins/switchery/switchery.min.css') }}" rel="stylesheet">
    <!-- apex css -->
    <link href="{{ asset('plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
    <!-- Slick css -->
    <link href="{{ asset('plugins/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/slick/slick-theme.css') }}" rel="stylesheet">
    <!-- DataTables css -->
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive Datatable css -->
    <link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- End css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <!-- Pnotify css -->
    <link href="{{ asset('plugins/pnotify/css/pnotify.custom.min.css') }}" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Latest compiled and minified CSS -->
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css">
    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- Include Toaster.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('front/main.css') }}">
    <link rel="stylesheet" href="{{ asset('front/button.css') }}">
    <link rel="stylesheet" href="{{ asset('front/input.css') }}">
    <link rel="stylesheet" href="{{ asset('front/breadcrumbs.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('front/modal.css') }}"> --}}

    <style>
        /* input:not([type=file], [type=search]), */
        textarea,
        select {
            border: 2px solid #e4dfdf !important;
        }

        .print-only {
            display: none;
        }

        @media print {
            .no-print {
                display: none;
            }

            .print-only {
                display: block;
            }

            .ui-pnotify-container {
                display: none !important;
            }

            @livewireScripts {
                display: none !important;
            }
        }

        .scrollable-div {
            width: 100%;
            overflow: visible;
        }
    </style>
