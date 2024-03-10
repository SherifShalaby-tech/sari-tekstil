@extends('layouts.app')
@section('title', __('lang.squeeze'))


@section('page_title')
    {{ __('lang.squeeze') }}
@endsection

@section('breadcrumbs')
    @parent
    <li class="last active"><a href="#">@lang('lang.squeeze')</a></li>
@endsection


@section('content')
    <!-- Start Contentbar -->
    <div class="contentbar">
        <livewire:squeeze-requests :quantity="$pressing_request->quantity" :weight="$pressing_request->weight" :pressingrequestid="$pressing_request->id" />
    </div>
    <!-- End Contentbar -->
@endsection
@push('javascripts')
    <script>
        $(document).on('click', '.print-staker', function() {
            $.ajax({
                method: "get",
                url: "/print-bale-staker/" + $(this).siblings('.bale_id').val(),
                success: function(response) {
                    console.log(response)
                    if (response !== '') {
                        pos_print(response);
                    }
                }
            });
        });

        function pos_print(receipt) {
            $("#receipt_section").html(receipt);
            const sectionToPrint = document.getElementById('receipt_section');
            __print_receipt(sectionToPrint);
        }

        function __print_receipt(section = null) {
            setTimeout(function() {
                section.style.display = 'block';
                window.print();
                section.style.display = 'none';

            }, 1000);
        }
    </script>
    {{-- <script src="{{ asset('app-js/compression.js') }}"></script> --}}
@endpush
