    <!-- Start js -->
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>     --}}

    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/modernizr.min.js')}}"></script>
    <script src="{{asset('js/detect.js')}}"></script>
    <script src="{{asset('js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('js/vertical-menu.js')}}"></script>
    <!-- Switchery js -->
    <script src="{{asset('plugins/switchery/switchery.min.js')}}"></script>
    <!-- Apex js -->
    <script src="{{asset('plugins/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('plugins/apexcharts/irregular-data-series.js')}}"></script>
    <!-- Slick js -->
    <script src="{{asset('plugins/slick/slick.min.js')}}"></script>
    <!-- Dashboard js -->
    <script src="{{asset('js/custom/custom-dashboard-ecommerce.js')}}"></script>
    <!-- Core js -->
    <script src="{{asset('js/core.js')}}"></script>
    <script src="{{ asset('lang/'.app()->getLocale().'.js') }}"></script>
    <!-- Datatable js -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/custom/custom-table-datatable.js') }}"></script>
    <!-- Pnotify js -->
    <script src="{{asset('plugins/pnotify/js/pnotify.custom.min.js')}}"></script>
    <script src="{{asset('js/custom/custom-pnotify.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="{{asset('js/summernote.min.js')}}" referrerpolicy="origin"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
     <!-- ++++++ Include Select2 JS ++++++ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- Include Toaster.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
    <!-- ++++++ Include Jquery ++++++ -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <!-- Include Bootstrap-Select CSS and JS -->
    <!-- Latest compiled and minified JavaScript -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> --}}

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <!-- End js -->
    <script>
        // +++++++++++++ select2 +++++++++++
        $(document).ready(function() {
            $('.select2').select2();
        });

        @if (session('status'))
                  new PNotify( {
                      title: '{{ session('status.msg') }} !', text: '{{ session('status.msg') }}',
                      @if (session('status.success') == '1')
                          type: "success"
                      @else
                          type:"Error"
                      @endif
                  });
          @endif
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
        $(document).on('click', '.delete_item', function(e) {
              e.preventDefault();
              swal({
                  title: LANG.are_you_sure,
                  text: LANG.are_you_sure_you_wanna_delete_it,
                  icon: 'warning',
              }).then(willDelete => {
                  if (willDelete) {
                      // var check_password = $(this).data('check_password');
                      var href = $(this).data('href');
                      var data = $(this).serialize();

                      swal({
                          title: "{!!__('lang.please_enter_your_password')!!}",
                          content: {
                              element: "input",
                              attributes: {
                                  placeholder:"{!!__('lang.type_your_password')!!}",
                                  type: "password",
                                  autocomplete: "off",
                                  autofocus: true,
                              },
                          },
                          inputAttributes: {
                              autocapitalize: 'off',
                              autoComplete: 'off',
                          },
                          focusConfirm: true
                      }).then((result) => {
                          if (result) {
                              $.ajax({
                                  url: '/user/check-password/',
                                  method: 'POST',
                                  data: {
                                      value: result
                                  },
                                  dataType: 'json',
                                  success: (data) => {

                                      if (data.success == true) {
                                          swal(
                                              'success',
                                              "{!!__('lang.correct_password')!!}",
                                              'success'
                                          );
                                          $.ajax({
                                              method: 'DELETE',
                                              url: href,
                                              dataType: 'json',
                                              data: data,
                                              success: function(result) {
                                                  if (result.success == true) {
                                                      new PNotify( {
                                                          title: result.msg, text: 'Check me out! I\'m a notice.', type: 'success'
                                                      });
                                                      setTimeout(() => {
                                                          location
                                                              .reload();
                                                      }, 1500);
                                                      location.reload();
                                                  } else {
                                                      new PNotify( {
                                                          title: result.msg, text: 'Check me out! I\'m a notice.', type: 'error'
                                                      });
                                                  }
                                              },
                                          });

                                      } else {
                                          swal(
                                              'Failed!',
                                              'Wrong Password!',
                                              'error'
                                          )

                                      }
                                  }
                              });
                          }
                      });
                  }
              });
          });
          //open edit modal for modules
          $(document).on('click', '.btn-modal', function(e) {
              e.preventDefault();
              var container = $(this).data('container');
              $.ajax({
                  url: $(this).data('href'),
                  dataType: 'html',
                  success: function(result) {
                      $(container).html(result);
                      $('.selectpicker').selectpicker();
                      $('#editModal').modal('show');
                  },
              });
          });
          $(document).ready(function() {
                $('.selectpicker').selectpicker();
            });

  </script>
  @stack('javascripts')



