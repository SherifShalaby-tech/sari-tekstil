<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themesbox.in/admin-templates/minaati/html/light-vertical/dashboard-ecommerce.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Aug 2023 11:53:58 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Minaati is a bootstrap minimal & clean admin template">
    <meta name="keywords"
        content="admin, admin panel, admin template, admin dashboard, admin theme, bootstrap 4, responsive, sass support, ui kits, crm, ecommerce">
    <meta name="author" content="Themesbox17">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>@yield('title')</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="{{ asset('/uploads/' . $settings['logo']) }}">
    @include('layouts.partials.css')
    @stack('css')
    @livewireStyles
</head>

<body class="vertical-layout">

    <div class="loading-background">
    </div>


    <!-- Start Infobar Setting Sidebar -->
    <div id="infobar-settings-sidebar" class="infobar-settings-sidebar no-print">
        <div class="infobar-settings-sidebar-head d-flex w-100 justify-content-between">
            <h4>Settings</h4><a href="javascript:void(0)" id="infobar-settings-close" class="infobar-settings-close"><i
                    class="ri-close-line menu-hamburger-close"></i></a>
        </div>
        <div class="infobar-settings-sidebar-body">
            <div class="custom-mode-setting">
                <div class="row align-items-center pb-3">
                    <div class="col-8">
                        <h6 class="mb-0">Payment Reminders</h6>
                    </div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-first" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8">
                        <h6 class="mb-0">Stock Updates</h6>
                    </div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-second" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8">
                        <h6 class="mb-0">Open for New Products</h6>
                    </div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-third" /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8">
                        <h6 class="mb-0">Enable SMS</h6>
                    </div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-fourth" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8">
                        <h6 class="mb-0">Newsletter Subscription</h6>
                    </div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-fifth" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8">
                        <h6 class="mb-0">Show Map</h6>
                    </div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-sixth" /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8">
                        <h6 class="mb-0">e-Statement</h6>
                    </div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-seventh" checked /></div>
                </div>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h6 class="mb-0">Monthly Report</h6>
                    </div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-eightth" checked /></div>
                </div>
            </div>
        </div>
    </div>
    <div class="infobar-settings-sidebar-overlay no-print"></div>
    <!-- End Infobar Setting Sidebar -->
    <!-- Start Containerbar -->
    <div id="containerbar" class="no-print">
        <!-- Start Leftbar -->
        @include('layouts.partials.sidebar')
        <!-- End Leftbar -->
        <!-- Start Rightbar -->
        <div class="rightbar">
            <!-- Start Topbar -->
            @include('layouts.partials.topbar')
            <!-- End Topbar -->
            @yield('breadcrumbbar')
            <!-- Start Breadcrumbbar -->
            <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="media">
                            <div class="wrapper">
                                <div class="description">
                                    <h3>@yield('page_title')</h3>
                                    {{-- <p>Perfect for pages with long titles</p> --}}
                                </div>
                                <ul class="breadcrumbs">
                                    @section('breadcrumbs')

                                        <li class="first"><a href="{{ url('/') }}" class=""><i
                                                    class="fas fa-home"></i></a>
                                        </li>
                                    @show
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="widgetbar">
                            @yield('button')
                        </div>
                    </div>
                </div>
            </div>



            <div class="animate-in-page">
                @yield('content')
            </div>

            <!-- Start Footerbar -->
            {{-- <div class="footerbar no-print">
                <footer class="footer">
                    <p class="mb-0">© 2023 {{ $settings['site_title'] }}- {{ __('lang.developed_by') }}:
                        {{ $settings['developed_by'] }} - All Rights Reserved.</p>
                </footer>
            </div> --}}
            <!-- End Footerbar -->
        </div>
        <!-- End Rightbar -->
    </div>




    <div class="bg-start"></div>


    <!-- End Containerbar -->
    @include('layouts.partials.javascript')
    @livewireScripts
    <section class="invoice print_section print-only" id="receipt_section"> </section>
    <script>
        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
            });
        });
        window.addEventListener('swal:confirm', event => {
            swal({
                    title: event.detail.message,
                    text: event.detail.text,
                    icon: event.detail.type,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.livewire.emit('remove');
                    }
                });
        });
    </script>

    {{-- <script>
        $('.menubar').on('click', function() {
            $('.side_bar_title').toggleClass('d-none');
        })
        $('.leftbar').on('mouseenter', function() {
            $('.side_bar_title').addClass('d-block');

        })
        $('.leftbar').on('mouseleave', function() {
            $('.side_bar_title').addClass('d-none');

        })
    </script> --}}

    <script>
        function loadingHandler(className, route) {
            var num = 15;

            var modalBtn = document.querySelector(`.${className}`);

            var loadingBackground = document.querySelector('.loading-background');
            var holdModals = document.createDocumentFragment();

            for (var i = 0; i < num; i++) {
                var div = document.createElement('div');
                div.classList.add('modal-drop');
                div.style.top = Math.floor((Math.random() * 100)) + 'vh';
                div.style.left = Math.floor((Math.random() * 100)) + 'vw';
                div.style.transitionDelay = Math.random() + 's';
                holdModals.appendChild(div);
            }
            loadingBackground.appendChild(holdModals);

            modalBtn.addEventListener('click', function() {
                loadingBackground.style.display = 'block';
                window.setTimeout(function() {
                    loadingBackground.classList.add('active');

                }, 0.01);
                window.setTimeout(function() {

                    window.location.href = route;
                }, 1000);

            });

            closeBtn.addEventListener('click', function() {
                loadingBackground.classList.remove('active');

                window.setTimeout(function() {
                    loadingBackground.style.display = 'none';
                }, 3000);
            });
        }
        loadingHandler('transporter-button', "{{ route('transporter.index') }}")
    </script>
</body>

</html>
